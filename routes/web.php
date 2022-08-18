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
//
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
Route::get('youtube','CrudController@getVideo')->middleware('auth');





//prefix Route for  multi lenge
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('offers.store');
        Route::get('all','CrudController@getAllOffers')->name('offers.all');

        Route::get('edit/{offer_id}','CrudController@editOffer');
        Route::post('update/{offer_id}','CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}','CrudController@deleteOffer')->name('offers.delete');
    });
});

//ajaxOffer Routs
Route::group(['prefix'=>'ajax-offers'],function (){
   Route::get('create','OfferController@createOffer')->name('ajaxoffer.create');
   Route::post('store','OfferController@storeOffer')->name('ajaxoffer.store');
   Route::get('all','OfferController@all')->name('ajaxoffer.all');
   Route::post('delete','OfferController@delete')->name('ajaxoffer.delete');
    Route::get('edit/{offer_id}','OfferController@edit')->name("ajaxoffer.edit");
    Route::post('update','OfferController@update')->name('ajaxoffer.update');
});



#################### Begin Authentication && Guards ###############
Route::group(['middleware'=>'CheckAge','namespace'=>'Auth'],function (){
    Route::get('adults','CustomAuthController@Adualt')->name('adult') ;

});
 Route::get("test",function (){
     return "Not adults";
 })->name('test');

//gurdes
Route::get('admin','Auth\CustomAuthController@admin')->name('admin')->middleware('auth:admin') ;
Route::get('site','Auth\CustomAuthController@site')->name('site')->middleware('auth:web') ;
Route::get('admin/login','Auth\CustomAuthController@login')->name('admin.login')  ;
Route::post('admin/login','Auth\CustomAuthController@checkAdminLogin')->name('save.admin.login')  ;


#################### End Authentication && Guards #################


################## Begin realtions routs ############
Route::get('has-one', 'RelationsController\RelationsController@hasOneRelation');
Route::get('has-one-resrve', 'RelationsController\RelationsController@hasOneRelationResrve');
Route::get('get-user-has-phone', 'RelationsController\RelationsController@getUserHasPhone');
Route::get('get-user-not-has-phone', 'RelationsController\RelationsController@getUserNotHasPhone');


################## End realtions routs ############
