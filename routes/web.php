<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', ['middleware'=>'auth','uses'=>'CustomerController@getDashboard']);

Route::group(['prefix'=>'user'],function(){
Route::get('token',['middleware'=>'auth','uses'=>'PublicController@addTokenData']);
});



Route::group(['prefix'=>'user'],function(){
Route::get('all',['middleware'=>'auth','uses'=>'CustomerController@allCustomerData']);
Route::get('add',['middleware'=>'auth','uses'=>'CustomerController@addCustomerPage']);
Route::post('add',['middleware'=>'auth','uses'=>'CustomerController@addCustomerData']);
Route::get('delete/{id}',['middleware'=>'auth','uses'=>'CustomerController@deleteCustomerData']);
Route::post('edit/{id}',['middleware'=>'auth','uses'=>'CustomerController@updateCustomerData']);
Route::get('view/{id}',['middleware'=>'auth','uses'=>'CustomerController@editCustomerPage']);
Route::get('get-area',['middleware'=>'auth','uses'=>'CustomerController@getArea']);
});



Route::group(['prefix'=>'employee'],function(){
Route::get('all',['middleware'=>'auth','uses'=>'CustomerController@allEmployeeData']);
Route::get('add',['middleware'=>'auth','uses'=>'CustomerController@addEmployeePage']);
Route::post('add',['middleware'=>'auth','uses'=>'CustomerController@addEmployeeData']);
Route::get('delete/{id}',['middleware'=>'auth','uses'=>'CustomerController@deleteEmployeeData']);
Route::post('edit/{id}',['middleware'=>'auth','uses'=>'CustomerController@updateEmployeeData']);
Route::get('view/{id}',['middleware'=>'auth','uses'=>'CustomerController@editEmployeePage']);
});

Route::group(['prefix'=>'barcode'],function(){
Route::get('all',['middleware'=>'auth','uses'=>'OrderController@allBarcode']);
Route::get('add',['middleware'=>'auth','uses'=>'OrderController@addBarcodePage']);
Route::post('add',['middleware'=>'auth','uses'=>'OrderController@addBarcode']);
Route::post('print/{id}/{address}',['middleware'=>'auth','uses'=>'OrderController@printBarcode']);
Route::get('print-all',['middleware'=>'auth','uses'=>'OrderController@printAllBarcode']);
Route::get('delete/{id}',['middleware'=>'auth','uses'=>'OrderController@deleteBarcode']);
Route::get('getHajeriShed',['middleware'=>'auth','uses'=>'OrderController@getHajeriShed']);
});

Route::group(['prefix'=>'wards'],function(){
Route::get('all',['middleware'=>'auth','uses'=>'WardController@allWard']);
Route::get('edit/{id}',['middleware'=>'auth','uses'=>'WardController@addWardPage']);
Route::post('edit/{id}',['middleware'=>'auth','uses'=>'WardController@updateWardData']);
Route::post('add',['middleware'=>'auth','uses'=>'WardController@addWard']);
Route::post('print/{id}/{address}',['middleware'=>'auth','uses'=>'WardController@printWard']);
Route::get('delete/{id}',['middleware'=>'auth','uses'=>'WardController@deleteWard']);
});


Route::group(['prefix'=>'hajeri-shed'],function(){
Route::get('all',['middleware'=>'auth','uses'=>'HajeriController@allShed']);
Route::get('edit/{id}',['middleware'=>'auth','uses'=>'HajeriController@addShedPage']);
Route::post('edit/{id}',['middleware'=>'auth','uses'=>'HajeriController@updateShedData']);
Route::post('add',['middleware'=>'auth','uses'=>'HajeriController@addShed']);
Route::get('delete/{id}',['middleware'=>'auth','uses'=>'HajeriController@deleteShed']);
});


Route::group(['prefix'=>'report'],function(){
Route::get('view/{id}',['middleware'=>'auth','uses'=>'BookingController@getReportDetails']);
Route::get('all',['middleware'=>'auth','uses'=>'BookingController@getAllReports']);
Route::get('allData',['middleware'=>'auth','uses'=>'BookingController@getAllReportsData']);
Route::get('export-excel',['middleware'=>'auth','uses'=>'BookingController@exportExcel']);
});

Route::group(['prefix'=>'offer'],function(){
Route::get('add',['middleware'=>'auth','uses'=>'BookingController@getAddOffer']);
Route::post('add',['middleware'=>'auth','uses'=>'BookingController@addOffer']);
});

Route::group(['prefix'=>'facilities'],function(){
Route::get('all',['middleware'=>'auth','uses'=>'BookingController@allFacilities']);
Route::post('add',['middleware'=>'auth','uses'=>'BookingController@addFacilities']);
Route::get('status/{id}/{status}',['middleware'=>'auth','uses'=>'BookingController@updateStatus']);
});
