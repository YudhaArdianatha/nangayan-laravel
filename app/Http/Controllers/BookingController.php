<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Room;
use App\Models\RoomNumber;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Snap;

class BookingController extends Controller
{

    public function index()
    {
        $rooms = Room::all();
        return view('suites', compact('rooms'));
    }
    public function create(Room $room){
        return view('orders.orderDetail', compact('room'));
    }

    public function store(Request $request, Room $room){
        $validated = $request->validate([
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
            'num_of_rooms' => 'required|numeric|min:1',
        ]);
    
        $available_rooms = $room->getAvailableRooms($validated['checkin_date'], $validated['checkout_date']);
    
        if ($available_rooms < $validated['num_of_rooms']) {
            return back()->with('num_of_rooms', "Hanya tersedia $available_rooms kamar dari tanggal " . 
                $validated['checkin_date'] . " hingga " . $validated['checkout_date']);
        }
    
        // Buat booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'checkin_date' => $validated['checkin_date'],
            'checkout_date' => $validated['checkout_date'],
            'num_of_rooms' => $validated['num_of_rooms'],
            'slug' => Str::slug($room->room_type . '-' . time()),
        ]);
    
        // Alokasi room_number untuk booking
        $allocatedRoomNumbers = $this->allocateRoomNumbers($room, $validated['num_of_rooms'], $booking->id);
    
        // Update ketersediaan kamar
        $room->available_rooms -= $validated['num_of_rooms'];
        $room->save();
    
        return redirect()->route('bookings.show', ['booking' => $booking->slug]);
    }
    
    // Method untuk alokasi room_number
    private function allocateRoomNumbers(Room $room, int $numOfRooms, int $bookingId)
    {
        // Ambil room_number yang sudah digunakan
        $usedRoomNumbers = RoomNumber::where('room_id', $room->id)->pluck('room_number')->toArray();
    
        // Hitung total room_number yang tersedia untuk room_type ini
        $totalRooms = $room->total_rooms;
        $availableRoomNumbers = array_diff(range(1, $totalRooms), $usedRoomNumbers);
    
        // Ambil room_number yang tersedia sesuai jumlah num_of_rooms
        $allocatedRoomNumbers = array_slice($availableRoomNumbers, 0, $numOfRooms);
    
        // Simpan room_number yang dialokasikan ke database
        foreach ($allocatedRoomNumbers as $roomNumber) {
            RoomNumber::create([
                'room_id' => $room->id,
                'booking_id' => $bookingId,
                'room_number' => $roomNumber,
            ]);
        }
    
        return $allocatedRoomNumbers;
    }
    

    public function show(Booking $booking){
        $services = Service::all();
        $user = $booking->user;
        $room = $booking->room;

        $roomImage = $room->photos->where('photo_type', 'room_image')->first();

        return view('orders.order', compact('booking', 'services', 'user', 'room', 'roomImage'));
    }

    public function calculateTotal(Request $request, Booking $booking)
    {
        $checkinDate = Carbon::parse($booking->checkin_date);
        $checkoutDate = Carbon::parse($booking->checkout_date);
        $numOfNights = $checkoutDate->diffInDays($checkinDate);

        $roomPrice = $booking->room->room_price;
        $numOfRooms = $booking->num_of_rooms;
        
        $serviceId = $request->session()->get('service_id');
        $quantity = $request->session()->get('quantity');

        $totalRoomPrice = $roomPrice * $numOfNights * $numOfRooms;

        if ($serviceId && $quantity) {
            $servicePrice = Service::find($serviceId)->service_price;
            $totalServicePrice = $servicePrice * $numOfNights * $quantity;
        
            // Simpan ke tabel booking_services
            BookingService::create([
                'booking_id' => $booking->id,
                'service_id' => $serviceId,
                'quantity' => $quantity,
                'price' => $servicePrice * $quantity,
            ]);
        } else {
            $totalServicePrice = 0;
        }

        $totalAmount = $totalRoomPrice + $totalServicePrice;

        // Update the booking with calculated values
        $booking->update([
            'total_room_payment' => $totalRoomPrice,
            'total_service_payment' => $totalServicePrice,
            'total_payment' => $totalAmount,
        ]);

        // Clear session data
        $request->session()->forget(['service_id', 'quantity']);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $booking->slug . '-' . $booking->id,
                // 'order_id' => $booking->id,
                'gross_amount' => $totalAmount,
            ),
            'customer_details' => array(
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ),
        );
        
        $snapToken = Snap::getSnapToken($params);

        // dd($snapToken);

        $request->session()->forget(['service_id', 'quantity']);

        return view('orders.payment', compact('booking', 'numOfNights', 'numOfRooms', 'totalRoomPrice', 'totalServicePrice', 'totalAmount', 'snapToken'));
    }

    public function status()
    {
        // Ambil booking berdasarkan user login
        $booking = Booking::where('user_id', auth()->id())->latest()->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'No booking found.');
        }

        $bookingService = BookingService::where('booking_id', $booking->id)->with('service')->first();

        // Ambil data layanan, user, dan kamar terkait
        $services = Service::all();
        $user = $booking->user;
        $room = $booking->room;

        // Ambil room numbers terkait dengan booking
        $roomNumbers = $booking->roomNumbers;

        // Mengarahkan ke halaman status.blade.php dengan data booking, roomNumbers, dll.
        return view('status', compact('booking', 'services', 'user', 'roomNumbers', 'bookingService'));
    }


}
