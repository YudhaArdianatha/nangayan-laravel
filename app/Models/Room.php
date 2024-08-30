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
        });

        static::updating(function($room){
           $room->slug = Str::slug($room->room_type); 
        });
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }
}
