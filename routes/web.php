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

Auth::routes();

Route::get('/', 'AppointmentController@index');
Route::get('/home', 'AppointmentController@index')->name('home');

Route::post('/aanvraag/nieuw/{date}/{period}', 'AppointmentController@store');
Route::delete('/aanvraag/{appointment}', 'AppointmentController@destroy');

/**
 ***************
 * API routes
 ***************
 */

 Route::prefix('api')->group(function () {
     Route::get('appointments', 'AppointmentController@getAppointments');
     Route::get('appointments/{date}', 'AppointmentController@getAppointments');

     Route::get('appointments/filter', 'AppointmentController@getFilteredAppointments');
     Route::get('appointments/filter/{date}', 'AppointmentController@getFilteredAppointments');

     Route::get('weekdays', 'AppointmentController@getWeekdays');
     Route::get('weekdays/{date}', 'AppointmentController@getWeekdays');
 });

/**
 ***************
* Admin routes
***************
*/

  Route::prefix('admin')->middleware('admin')->group(function () {
      Route::get('/', 'AdminController@index');

      Route::get('/appointment/{appointment}', 'AdminController@show');
      Route::patch('/appointment/{appointment}', 'AdminController@update');
  });
