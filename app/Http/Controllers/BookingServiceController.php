<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingService;
use Illuminate\Http\Request;

class BookingServiceController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        // Validate the incoming request
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        // Store the service_id and quantity in the session
        $request->session()->put('service_id', $request->service_id);
        $request->session()->put('quantity', $request->quantity);

        // Redirect to the payment page
        return redirect()->route('bookings.payment', ['booking' => $booking->slug]);
    }
    
}
