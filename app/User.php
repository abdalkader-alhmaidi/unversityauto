<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//for helper methods passport
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;
   //Relations
    public function categoty()
    {
        return $this->belongsTo('App\Category');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
    public function matrials()
    {
        return $this->belongsToMany('App\Matrial');
    }
    public function role()
    {
        return $this->belongsTo('App\Role');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','category_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
