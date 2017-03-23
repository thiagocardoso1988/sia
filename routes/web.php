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

Route::get('/', function () {
    return view('site.index');
});


Route::get('/register', 'RegistrationController@register');
Route::post('/register', 'RegistrationController@postRegister');
Route::get('/login', 'LoginController@login');
Route::post('/login', 'LoginController@postLogin');
Route::post('/logout', 'LoginController@logout');


Route::group(['prefix' => 'app'], function(){
    Route::get('index', 'AppController@index')->name('appindex.show');
    Route::post('index', 'AppController@index')->name('appindex.show');
    Route::get('dispositivos', 'AppController@getDevices')->name('appdevices.show');
    Route::post('dispositivos', 'PlacaController@postDevices')->name('appdevices.store');
    Route::get('historico', 'AppController@getHistory')->name('apphistory.show');
    Route::post('historico', 'AppController@getHistory')->name('apphistory.show');
});

Route::get('/testdata', 'TestDataController@index');
Route::post('/testdata', 'TestDataController@process');