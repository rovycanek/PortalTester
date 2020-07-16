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

Route::get('/', 'PagesController@index');
Route::post('/tests/SH', 'TestController@SecurityHeaders');
Route::post('/tests/HS', 'TestController@Handshakesimulation');
Route::post('/tests/SV', 'TestController@Securitybreaches');
Route::post('/tests/CP', 'TestController@Offeredprotocols');
Route::post('/tests/SHE', 'TestController@Serverhello');
Route::post('/tests/CPP', 'TestController@Ciphersperprotocol');
Route::post('/tests/start', 'TestController@store');

Route::get('/about', 'PagesController@about');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::resource('LoginLog','LoginLogController',['except'=>['create', 'store', 'show', 'edit', 'update', 'destroy']])->middleware('can:login-history');
Route::resource('tests','TestController',['except'=>['create', 'edit', 'update', 'destroy']])->middleware('can:testing-history');
Route::resource('IPs','IPsController',['except'=>[ 'show']])->middleware('can:work-IPs');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('users','UsersController', ['except'=>['create', 'store', 'show']]);
    Route::resource('colors', 'ColorsController',['except'=>['create', 'show', 'destroy']]);
    Route::resource('IPs','IPsController',['except'=>[ 'show']]);
    Route::resource('tests','TestController',['except'=>['create', 'edit', 'update', 'destroy']]);
    Route::resource('testSsl','TestSslController',['except'=>['store', 'show', 'edit', 'update', 'destroy']]);
});