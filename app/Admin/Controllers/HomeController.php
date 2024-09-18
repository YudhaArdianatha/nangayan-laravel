<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Content $content)
     {
         return $content
             ->header('Dashboard')
             ->description('Report Overview')
             ->body(view('laravel-admin.charts', [
                 'dates' => $this->getRevenueByDateData()['dates'],
                 'revenues' => $this->getRevenueByDateData()['revenues'],
                 'roomTypes' => $this->getRevenueByRoomTypeData()['roomTypes'],
                 'revenues' => $this->getRevenueByRoomTypeData()['revenues'],
                 'statuses' => $this->getRevenueByStatusData()['statuses'],
                 'revenues' => $this->getRevenueByStatusData()['revenues'],
                 'users' => $this->getRevenueByUserData()['users'],
                 'revenues' => $this->getRevenueByUserData()['revenues']
             ]));
     }

     protected function getRevenueByDateData()
     {
         $bookings = Booking::select(DB::raw('DATE(checkin_date) as date'), DB::raw('SUM(total_payment) as total'))
             ->groupBy('date')
             ->orderBy('date')
             ->get();
 
         return [
             'dates' => $bookings->pluck('date'),
             'revenues' => $bookings->pluck('total')
         ];
     }
 
     protected function getRevenueByRoomTypeData()
     {
         $bookings = Booking::select('room_type', DB::raw('SUM(total_payment) as total'))
             ->join('rooms', 'rooms.id', '=', 'bookings.room_id')
             ->groupBy('room_type')
             ->orderBy('total', 'desc')
             ->get();
 
         return [
             'roomTypes' => $bookings->pluck('room_type'),
             'revenues' => $bookings->pluck('total')
         ];
     }
 
     protected function getRevenueByStatusData()
    {
        // Mengelompokkan total pembayaran berdasarkan status
        $bookings = Booking::select('status', DB::raw('SUM(total_payment) as total'))
            ->groupBy('status')
            ->orderBy('status') // Urutkan jika perlu
            ->get();

        // Pastikan status 'Paid' dan 'Unpaid' diurutkan dengan benar
        $statuses = ['Paid', 'Unpaid']; // Urutan status harus sesuai dengan data di database
        $revenues = [
            $bookings->where('status', 'Paid')->sum('total'),
            $bookings->where('status', 'Unpaid')->sum('total')
        ];

        return [
            'statuses' => $statuses,
            'revenues' => $revenues
        ];
    }

 
     protected function getRevenueByUserData()
     {
         $bookings = Booking::select('user_id', DB::raw('SUM(total_payment) as total'))
             ->groupBy('user_id')
             ->orderBy('total', 'desc')
             ->get();
 
         $users = $bookings->map(function ($booking) {
             return User::find($booking->user_id)->name;
         });
 
         return [
             'users' => $users,
             'revenues' => $bookings->pluck('total')
         ];
     }
}
