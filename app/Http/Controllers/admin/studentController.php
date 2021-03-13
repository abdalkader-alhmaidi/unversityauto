<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category ;
use App\User ;
use App\Role ;
use Illuminate\Support\Facades\DB;


use App\Traits\ApiResponser ;
//for export excel
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
//for import excel

use App\Imports\UsersImport;




class studentController extends Controller
{
    use ApiResponser; 
    public function index() {
      
        $categories = Category::select('name')->distinct()->get();
        $categories = $categories->toArray();

        foreach ($categories as $value) {  $cat[] = $value['name'] ;   }
        return  $this->success($cat,'categories',200);
    }
    public function years($cat){
        $years = Category::select('year')->where('name',$cat)->get();
        $years = $years->toArray();

        foreach ($years as $value) {  $year[] = $value['year'] ;   }
        sort($year);
        return  $this->success($year,'years',200);

    }


    public function students($cat,$year){

          $students =DB::table('users')
                   ->join('categories', 'users.category_id', '=', 'categories.id')
                   ->where('categories.name',$cat)->where('categories.year',$year)
                   ->select('users.id','users.id_student','users.name','users.email','users.role_id','users.category_id')
                   ->get();
     
        return  $this->success($students,'students',200);
    }


    public function addStudent($cat,$year,Request $request){
        $cat = Category::where('name',$cat)->where('year',$year)->first()->id;
        $request = $this->vailateAddStudent($request);
        $user= User::create([
             'id_student'=> $request['id_student'] ,
             'name'=>$request['name'] , 
             'email'=> $request['email'],
             'password'=> bcrypt($request['password']),
             'role_id'=> 'student' ,
             'category_id'=>$cat ,
              ]);
        return  $this->success($user,'add student',200);

        
            
    }
    protected function vailateAddStudent($request){
        return  $request->validate(
            [
                'id_student'=> 'required|unique:users|integer',
                'name'=> 'required',
                'email'=> 'required|email|unique:users',
                'password'=> 'required|min:6',
                //'role_id'=> 'required|integer',
                //'category_id'=> 'required|integer',
            ]
        );
    }

    public function deleteStudent($id){
       $user = User::where('id',$id)->delete();
       return  $this->success([],'delete success',200);
    }

    public function editStudent($id,Request $request){
     $user = User::where('id',$id)->first();
     $request = $this->vailateeditStudent($request);
     $user->update($request);
     return  $this->success([],'edit success',200);
    }

    protected function vailateeditStudent($request){
        return  $request->validate(
            [
                'id_student'=> 'required|unique:users|integer',
                'name'=> 'required',
                'email'=> 'required|email|unique:users',
                'password'=> 'required|min:6',
                'role_id'=> 'required|integer',
                'category_id'=> 'required|integer',
            ]
        );
    }

    
    public function deleteStudents($cat,$year){
        $students = Category::where('name',$cat)->where('year',$year)->get();
         $students  ;
         foreach ($students as  $student) {
             User::find($student->id)->delete();
            return  $this->success([],'delete success',200);
         }
       
    }
    public function exportStudentByExcel($cat,$year){
     
      return Excel::download(new UsersExport($cat,$year), 'users.xlsx');
     
    }
    public function importStudentByExcel ($cat,$year){

        Excel::import(new UsersImport($cat,$year), request()->file('users'));
    }
    
}
