<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot(){

        parent::boot();

        static::creating(function($room){
           $room->slug = Str::slug($room->room_type);
           $room->available_rooms = $room->total_rooms; 
        });

        static::updating(function($room){
           $room->slug = Str::slug($room->room_type); 
        });
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function checkAvailability($checkin_date, $checkout_date, $num_of_rooms)
    {
        // Hitung jumlah kamar yang sudah dipesan pada rentang tanggal yang sama
        $booked_rooms = $this->bookings()
            ->where(function ($query) use ($checkin_date, $checkout_date) {
                $query->whereBetween('checkin_date', [$checkin_date, $checkout_date])
                      ->orWhereBetween('checkout_date', [$checkin_date, $checkout_date])
                      ->orWhere(function ($query) use ($checkin_date, $checkout_date) {
                          $query->where('checkin_date', '<=', $checkin_date)
                                ->where('checkout_date', '>=', $checkout_date);
                      });
            })
            ->sum('num_of_rooms');
        
        // Cek apakah kamar tersedia
        $available_rooms = $this->total_rooms - $booked_rooms;

        return $available_rooms >= $num_of_rooms;
    }

    public function getAvailableRooms($checkin_date, $checkout_date)
    {
        // Hitung jumlah kamar yang sudah dipesan pada rentang tanggal yang sama
        $booked_rooms = $this->bookings()
            ->where(function ($query) use ($checkin_date, $checkout_date) {
                $query->whereBetween('checkin_date', [$checkin_date, $checkout_date])
                      ->orWhereBetween('checkout_date', [$checkin_date, $checkout_date])
                      ->orWhere(function ($query) use ($checkin_date, $checkout_date) {
                          $query->where('checkin_date', '<=', $checkin_date)
                                ->where('checkout_date', '>=', $checkout_date);
                      });
            })
            ->sum('num_of_rooms');

        // Hitung jumlah kamar yang masih tersedia
        return $this->total_rooms - $booked_rooms;
    }

}
