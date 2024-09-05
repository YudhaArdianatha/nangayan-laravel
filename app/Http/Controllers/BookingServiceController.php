<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingService;
use Illuminate\Http\Request;

class BookingServiceController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        $serviceId = $request->service_id;
        $quantity = $request->quantity;

        $request->session()->put('service_id', $serviceId);
        $request->session()->put('quantity', $quantity);

        return redirect()->route('bookings.payment', $booking->slug);
    }
    
}
