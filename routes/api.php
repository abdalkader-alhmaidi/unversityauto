<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix' => 'auth'], function () {
    Route::post('signup','AuthController@signup');
    Route::post('login','AuthController@login'); 
    
    

});
Route::prefix('doctor/schedule/')->group(function () {
    Route::get('show','doctor\scheduleController@show')->middleware('auth:api');
    Route::get('add','doctor\scheduleAdminController@add');
    Route::get('edit/{id}','doctor\scheduleAdminController@edit');
    Route::get('delete/{id}','doctor\scheduleAdminController@delete');

});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user','AuthController@user');
    Route::post('logout','AuthController@logout');  

});



Route::group(['prefix' => 'admin/Dashboard/'], function () {
    Route::post('','AuthController@signup');
    Route::post('','AuthController@login'); 


    Route::group(['prefix' => 'students/'], function () {
         //show categories
        Route::get('index','admin\studentController@index');
         //show the years for the specfic category 
        Route::get('index/{cat}','admin\studentController@years'); 
        //show the students for the specific year
        Route::get('index/{cat}/{year}','admin\studentController@students'); 
        //add  a student
        Route::post('index/{cat}/{year}/addstudent','admin\studentController@addStudent');
        //remove a student
        Route::delete('index/student/{id}/delete','admin\studentController@deleteStudent');
        //edit a student
        Route::put('index/student/{id}/edit','admin\studentController@editStudent');
        
        //remove all students in this category
        Route::delete('index/students/{cat}/{year}/delete','admin\studentController@deleteStudents');
        //add a set of students by the excel file [import]
        Route::post('index/{cat}/{year}/students/import/all','admin\studentController@importStudentByExcel');
        //export student file
        Route::get('index/{cat}/{year}/students/export/all','admin\studentController@exportStudentByExcel');






    });

});