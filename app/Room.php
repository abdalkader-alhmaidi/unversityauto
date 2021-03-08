<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
