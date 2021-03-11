<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\admin\Advertisment as adverResourse ;
use App\Advertisment;
use App\Category;
use App\Role;
use App\User ;
use App\Traits\ApiResponser ;
use Carbon\Carbon ;



class advertismentController extends Controller
{
    use ApiResponser;
    
    public function index(){
        $adver = Advertisment::where('period','>',Carbon::now())->get();

        return  $this->success(adverResourse::collection($adver),'advertisments',200);
    }

    public function adddAvertisment(Request $request){
        $roleId = Role::where('name','admin')->first()->id;
        $userId = User::where('role_id',$roleId)->first()->id;
        $request = $this->advertismentValidate($request);
         $adver= Advertisment::create([
        'title'=>$request['title'] ,
        'content'=>$request['content'] ,
        'period'=>$request['period'] ,
        'slice'=>implode(',',$request['slice']) ,
        'user_id'=> $userId,
        
        
     ]);
     return  $this->success($adver,'add Advertisment',200);
    }
    protected function advertismentValidate($request){
     return $request->validate([
        'title'=> 'required|string' ,
        'content'=>'required|string' ,
        'period'=>'required|date_format:Y-m-d H:i:s' ,
        'slice'=>'required|array' ,

     ]);
    } 

    public function deleteAdvertisment($id){

        Advertisment::find($id)->delete();
        return  $this->success([],'delete Advertisment',200);
    }

    public function  editAdvertisment($id,Request $request){
     $adver = Advertisment::where('id',$id)->first();
     $adver->update($request->all());
     return  $this->success([],'edit Advertisment',200);

    }
    

}
