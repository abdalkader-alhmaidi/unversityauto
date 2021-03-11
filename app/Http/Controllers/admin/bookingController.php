<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advertisment;
use App\Category;
use App\Role;
use App\Booking;
use App\User ;
use App\Traits\ApiResponser ;
use Carbon\Carbon ;
use Illuminate\Support\Facades\DB;


class bookingController extends Controller
{
   

    use ApiResponser;
    public function index(){
        $bookings = DB::table('bookings')
        ->join('categories', 'categories.id', '=', 'bookings.category_id')
        ->join('users', 'users.id', '=', 'bookings.user_id')
        ->join('rooms', 'rooms.id', '=', 'bookings.room_id')
        ->join('matrials', 'matrials.id', '=', 'bookings.matrial_id')
        ->select( 'bookings.id','users.name as user','rooms.name as room',
        'categories.name as category','bookings.day','bookings.lecture',
        'matrials.name as matrial')
        ->get();
        return  $this->success($bookings,'bookings',200);
    }
    public function adddBooking(Request $request){
     $request = $this->addBookingValidate($request);
     $booking= Booking::create($request);
    

     return  $this->success($booking,'add booking',200);
    }
    protected function addBookingValidate($request){
        return $request->validate([
           'user_id'=> 'required|integer' ,
           'room_id'=>'required|integer' ,
           'category_id'=>'required|integer' ,
           'matrial_id'=>'required|integer' ,
           'lecture'=>'required|integer' ,
           'day'=>'required|string' ,
           
   
        ]);
       } 

    public function deleteBooking($id){

        Booking::find($id)->delete();
        return  $this->success([],'delete booking',200);
    }
    public function  editBooking($id,Request $request){
     $book = Booking::where('id',$id)->first();
     $book->update($request->all());
     return  $this->success([],'edit book success',200);

    }
    

}
