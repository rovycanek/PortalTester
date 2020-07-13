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
Route::post('/tests/SH', 'TestsController@securityH');
Route::post('/tests/HS', 'TestsController@HandshakeSimulation');
Route::post('/tests/SV', 'TestsController@SecurityVulnerabities');
Route::post('/tests/CP', 'TestsController@ConnectionProtocols');
Route::post('/tests/SHE', 'TestsController@ServerHello');
Route::post('/tests/CPP', 'TestsController@CiphersPherProtocol');
Route::post('/tests/start', 'TestController@store');

Route::get('/about', 'PagesController@about');


Auth::routes();
Route::resource('LoginLog','LoginLogController')->middleware('can:login-history');
Route::resource('tests','TestController')->middleware('can:testing-history');
Route::resource('IPs','IPsController')->middleware('can:work-IPs');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('users','UsersController', ['except'=>['create', 'store']]);
    Route::resource('colors', 'ColorsController');
    Route::resource('IPs','IPsController');
    Route::resource('tests','TestController');
    Route::resource('testSsl','TestSslController');
});