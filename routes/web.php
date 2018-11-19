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

Route::get('/login', function () {
    return view('welcome');
});
Route::get('/test', function (){
    return 222;
});

Route::post('/postLogin', 'Auth\LoginController@postLogin');
Route::post('/welcome', 'Auth\LoginController@welcome');
Route::post('/pushTest', 'Backend\TestController@pushTest');
