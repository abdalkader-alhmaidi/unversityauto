<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','year','section'];
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function matrials()
    {
        return $this->hasMany('App\Matrial','catId', 'catId');
    }
}
