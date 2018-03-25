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

Route::get('/home', 'AppointmentController@index')->name('home');

Route::get('/', 'AppointmentController@index');

Route::delete('/aanvraag/{appointment}', 'AppointmentController@destroy');

Route::get('/api/appointments', 'AppointmentController@getAppointments');
Route::get('/api/appointments/{date}', 'AppointmentController@getAppointments');

Route::get('/api/appointments/filter', 'AppointmentController@getFilteredAppointments');
Route::get('/api/appointments/filter/{date}', 'AppointmentController@getFilteredAppointments');

Route::get('/api/weekdays', 'AppointmentController@getWeekdays');
Route::get('/api/weekdays/{date}', 'AppointmentController@getWeekdays');

Route::post('/aanvraag/nieuw/{date}/{period}', 'AppointmentController@store');
