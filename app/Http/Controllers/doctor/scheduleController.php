<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking ;
use Illuminate\Support\Facades\Auth ;

class scheduleController extends Controller
{
    public function show(){
        $userId= Auth::id();
       
        $bookings = Booking::with('user','room','category')->get();
      
      //  echo $u ;
       // dd();
             
        return response()->json($bookings, 200);
       
      }
      
}