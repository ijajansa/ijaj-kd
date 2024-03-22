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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Route::post('postLogin', 'CustomerController@postLogin');
// Route::post('addReport', 'BookingController@addReport');
// Route::post('addBarcodeProfile', 'BookingController@addBarcodeProfile');
// Route::post('getUserProfile', 'BookingController@getUserProfile');
// Route::post('getReportRecord', 'BookingController@getReportRecord');
// Route::post('addFirebaseToken', 'OrderController@addFirebaseToken');



Route::post('checkProfile', 'BookingController@checkProfile');
Route::post('postLogin', 'CustomerController@postLogin');
Route::post('addReport', 'BookingController@addReport');
Route::post('updateRemark', 'BookingController@updateRemark');
Route::post('getUserProfile', 'BookingController@getUserProfile');

Route::post('getReportRecord', 'BookingController@getReportRecord');
Route::post('addFirebaseToken', 'OrderController@addFirebaseToken');


