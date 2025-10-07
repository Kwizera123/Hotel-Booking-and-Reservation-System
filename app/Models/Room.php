<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
     protected $guarded = [];
         public function type(){
        return $this->belongsTo(RoomType::class,'roomtype_id','id');
    }

    public function room_numbers(){
        return $this->hasMany(RoomNumber::class, 'rooms_id')->where('status','Active');
    }
}
