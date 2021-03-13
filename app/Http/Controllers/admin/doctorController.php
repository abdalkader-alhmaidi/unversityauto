<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser ;
use App\Category ;
use App\User ;
use App\Role ;

use Illuminate\Support\Facades\DB;

class doctorController extends Controller
{
    use ApiResponser;

    public function index(){
      $doctors = User::where('role_id','doctor')->get(['id','name','email']);

        return  $this->success($doctors,'doctors',200);
    }

    public function addDoctor(Request $request){
        $request = $this->vailateAddDoctor($request);
        $user= User::create([
           //  'id_student'=> $request['id_student'] ,
             'name'=>$request['name'] , 
             'email'=> $request['email'],
             'password'=> bcrypt($request['password']),
             'role_id'=> 'doctor' ,
             'category_id'=> 1,
              ]);
        return  $this->success($user,'add doctor',200);

        
            
    }
    protected function vailateAddDoctor($request){
        return  $request->validate(
            [
                //'id_student'=> 'required|integer',
                'name'=> 'required',
                'email'=> 'required|email|unique:users',
                'password'=> 'required|min:6',
                //'role_id'=> 'required|integer',
                //'category_id'=> 'required|integer',
            ]
        );}
    
        public function deleteDoctor($id){
            $user = User::where('id',$id)->delete();
            return  $this->success([],'delete success',200);
         }

         public function editDoctor($id,Request $request){
            $user = User::where('id',$id)->first();
            $request = $this->vailateeditDoctor($request);
            $user->update($request);
            return  $this->success([],'edit success',200);
           }

           protected function vailateeditDoctor($request){
            return  $request->validate(
                [
                   // 'id_student'=> 'required|unique:users|integer',
                    'name'=> 'required',
                    'email'=> 'required|email|unique:users',
                    'password'=> 'required|min:6',
                   // 'role_id'=> 'required|integer',
                    //'category_id'=> 'required|integer',
                ]
            );
          }
        public function addDoctorMatrial($id,Request $request){
          
            $doctorId =User::find($id)->id;
              $matrial = $request['matrial'];;
            DB::insert("insert into matrial_user(user_id,matrial_id) values ($doctorId, $matrial)", [1, 'Dayle']);
            return  $this->success([],'add matrial success',200);
        }
        public function deleteDoctorMatrail($id,Request $request){
          
            $doctorId =User::find($id)->id;
            $matrial = $request['matrial'];;
           
            DB::delete("delete from matrial_user where user_id = $doctorId  AND matrial_id = $matrial");
            
            return  $this->success([],'delete matrial success',200);
        }         

}
