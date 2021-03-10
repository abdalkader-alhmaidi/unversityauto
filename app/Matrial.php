<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matrial extends Model
{
    public function category()
    {
        return $this->belongsToMany('App\Category','catId', 'catId');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
