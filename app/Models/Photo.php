<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Photo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot(){
        
        parent::boot();

        static::creating(function($photo){
           $photo->slug = Str::slug($photo->photo_path); 
        });

        static::updating(function($photo){
           $photo->slug = Str::slug($photo->photo_path);
        });
    }

    public function room(){
        return $this->belongsTo(room::class);
    }
}
