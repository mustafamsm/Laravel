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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/', function () {
    return "Home";
});

Route::get('fillable', 'CrudController@getOffers');
Route::get('youtube', 'CrudController@getVideo')->middleware('auth');


//prefix Route for  multi lenge
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('offers.store');
        Route::get('all', 'CrudController@getAllOffers')->name('offers.all');

        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@deleteOffer')->name('offers.delete');
    });
});

//ajaxOffer Routs
Route::group(['prefix' => 'ajax-offers'], function () {
    Route::get('create', 'OfferController@createOffer')->name('ajaxoffer.create');
    Route::post('store', 'OfferController@storeOffer')->name('ajaxoffer.store');
    Route::get('all', 'OfferController@all')->name('ajaxoffer.all');
    Route::post('delete', 'OfferController@delete')->name('ajaxoffer.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name("ajaxoffer.edit");
    Route::post('update', 'OfferController@update')->name('ajaxoffer.update');
});


#################### Begin Authentication && Guards ###############
Route::group(['middleware' => 'CheckAge', 'namespace' => 'Auth'], function () {
    Route::get('adults', 'CustomAuthController@Adualt')->name('adult');

});
Route::get("test", function () {
    return "Not adults";
})->name('test');

//gurdes
Route::get('admin', 'Auth\CustomAuthController@admin')->name('admin')->middleware('auth:admin');
Route::get('site', 'Auth\CustomAuthController@site')->name('site')->middleware('auth:web');
Route::get('admin/login', 'Auth\CustomAuthController@login')->name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@checkAdminLogin')->name('save.admin.login');


#################### End Authentication && Guards #################


################## Begin realtions routs ############
Route::get('has-one', 'RelationsController\RelationsController@hasOneRelation');
Route::get('has-one-resrve', 'RelationsController\RelationsController@hasOneRelationResrve');
Route::get('get-user-has-phone', 'RelationsController\RelationsController@getUserHasPhone');
Route::get('get-user-not-has-phone', 'RelationsController\RelationsController@getUserNotHasPhone');


################## Begin one to many realtion ###########
Route::get('hospital-has-many', 'RelationsController\RelationsController@getHospitalDoctors');
Route::get('hospitals', 'RelationsController\RelationsController@hostpitals')->name('all');
Route::get('hospitals/{hospital_id}', 'RelationsController\RelationsController@delete')->name('hospital.delete');

Route::get('doctors/{hospital_id}', 'RelationsController\RelationsController@doctors')->name('hospital.doctors');

Route::get('hospitals_has_doctors', 'RelationsController\RelationsController@hostpitalsHasDoctors');
Route::get('hospitals_has_doctors_male', 'RelationsController\RelationsController@hostpitalsHasDoctorsMale');
Route::get('hospitals_not_has_doctors', 'RelationsController\RelationsController@hostpitalsNotHasDoctors');


################ end one to many realtion ##############


############### Begin many to many realtion #############

Route::get('doctors-services','RelationsController\RelationsController@getDoctorService');
Route::get('services-doctors','RelationsController\RelationsController@getServiceDoctor');
Route::get('doctors/services/{doctors_id}', 'RelationsController\RelationsController@getDoctorServicesById')->name('doctor.service');
Route::post('saveServices-to-doctor','RelationsController\RelationsController@saveServicesToDoctor')->name('doctor.save');
############### end many to many realtion #############


############### end hasOneThrough realtion #############
Route::get('has-one-through','RelationsController\RelationsController@getPatientDoctor');

############### end hasOneThrough realtion #############

################## End realtions routs ############
