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

// Route::get('/', "NewsController@index");

// Route::get('/test1', function () {
//     return 'Welcome test';
// });



 


// //route paramters


// //requerd paramters
// Route::get('show-number/{id}', function ($id) {
//     return 'Welcome '.$id;
// })->name("a");


// //optional paramters
// Route::get('show-string/{id?}', function () {
//     return 'Welcome ';
// })->name("b");

// //route name

// //Route::get("first","Front\FirstController@showName");
// // Or
// Route::group(['namespace'=>'Front'],function (){
//     Route::get('first1','FirstController@showString1')->middleware('auth');
//     Route::get('first2','FirstController@showString2') ;
//     Route::get('first3','FirstController@showString3');
//     Route::get('first4','FirstController@showString4');
//     Route::get('index','UserController@getIndex');

// });
// Route::get('login',function (){
//     return "You  must by login to access this route";
// })->name('login');


// Route::resource('news',"NewsController");


// Route::get("landing",function (){
//     return view("index");
// });

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/',function(){
    return "Home";
}) ;

Route::get('fillable','CrudController@getOffers');