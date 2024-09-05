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

    public function checkAvailability($checkinDate, $checkoutDate, $numOfRooms)
    {
        $bookedRooms = Booking::where('room_id', $this->id)
                            ->where(function ($query) use ($checkinDate, $checkoutDate) {
                                $query->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
                                        ->orWhereBetween('checkout_date', [$checkinDate, $checkoutDate])
                                        ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                                            $query->where('checkin_date', '<=', $checkinDate)
                                                ->where('checkout_date', '>=', $checkoutDate);
                                        });
                            })
                            ->sum('num_of_rooms');

        return ($this->available_rooms - $bookedRooms) >= $numOfRooms;
    }

}
