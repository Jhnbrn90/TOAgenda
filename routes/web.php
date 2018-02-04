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

Route::get('/', 'AppointmentController@index')->middleware('auth');

Route::post('/aanvraag/nieuw/{date}/{period}', 'AppointmentController@store')->middleware('auth');