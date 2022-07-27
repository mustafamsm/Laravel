<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    return "Hello admin";
});

Route::namespace('Front')->group(function (){

    //all route only access controller or mehtods in folder name Front
//    Route::get("users",'UserController@showAdminName');



    Route::group(['prefix'=>"users",'middleware'=>'auth'],function (){
        Route::get('/',function (){
            return "Work";
        });
        Route::get('show','UserController@showUserName');
    });
});


// nbcbvcvcbvc



//Route::prefix('users')->group(function (){
//    Route::get('/',function (){
//        return "Work";
//    });
//    Route::get("show",'UserController@showUserName');
//});




