<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Room;
use App\Category;
use App\Traits\ApiResponser ;

class roomsController extends Controller
{
    use ApiResponser;
    public function index(){
        $rooms = Room::all(['id','name','capacity']);
        return  $this->success($rooms,'rooms',200);
    }
    public function addRooms(Request $request){
     $room= Room::create([
        'name'=>$request['name'] ,
        'capacity'=>$request['capacity'] ,
        'category_id'=>null ,
        
     ]);
     return  $this->success($room,'add room',200);
    }

    public function deleteRooms($id){

        Room::find($id)->delete();
        return  $this->success([],'delete room',200);
    }
    public function  editRooms($id,Request $request){
     $room = Room::where('id',$id)->first();
     $room->update($request->all());
     return  $this->success([],'edit success',200);

    }
    




}
