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

     Route::post('upload', 'FileController@store');
     Route::delete('upload', 'FileController@destroy');
 });

/**
 ***************
* Admin routes
***************
*/

  Route::prefix('admin')->middleware('admin')->group(function () {
      Route::get('/', 'AdminController@index')->name('admin-index');
      Route::get('/appointments/open', 'AdminController@indexOpenAppointments')->name('new-appointments');
      Route::get('/appointments/all', 'AdminController@indexAllAppointments')->name('all-appointments');

      Route::get('/appointment/{appointment}', 'AdminController@show');
      Route::patch('/appointment/{appointment}', 'AdminController@update');

      Route::get('/users', 'UserController@index')->name('users.index');
      Route::post('/users', 'UserController@store')->name('users.store');

      Route::get('/users/create', 'UserController@create')->name('users.create');

      Route::get('/users/{user}', 'UserController@show')->name('users.show');

      Route::patch('/users/{user}', 'UserController@update')->name('users.update');
  });
