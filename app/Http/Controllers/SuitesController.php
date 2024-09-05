<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class SuitesController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('suites', compact('rooms'));
    }

    // public function show($slug){
    //     $room = Room::where('slug', $slug)->first();
    //     return view('orders.orderDetail', compact('room'));
    // }

    // public function show(room $room)
    // {
    //     echo($room->room_type);
    //     return view('orders.orderDetail', compact('room'));
    // }
}
