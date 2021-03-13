<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Room;
use App\Category;
use App\Traits\ApiResponser ;

class categoryController extends Controller
{
    use ApiResponser;
    public function index(){
        $category = Category::all(['id','name','year','section']);
        return  $this->success($category,'categories',200);
    }
    public function addCategory(Request $request){
     $category= Category::create([
        'name'=>$request['name'] ,
        'year'=>$request['year'] ,
        'section'=>$request['section'] ,
        
     ]);
     return  $this->success($category,'add category',200);
    }

    public function deleteCategory($id){

        Category::find($id)->delete();
        return  $this->success([],'delete category',200);
    }
    public function  editCategory($id,Request $request){
     $category = Category::where('id',$id)->first();
     $category->update($request->all());
     return  $this->success([],'edit category success',200);

    }

    


}
