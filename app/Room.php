<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'capacity'
    ];
    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
