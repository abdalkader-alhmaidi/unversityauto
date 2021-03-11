<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{

 protected $fillable =['title','content','slice','period'];
    protected $dates = ['period','updated_at','created_at'];

}
