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

Route::get('/about', 'PagesController@about');


Auth::routes();
Route::resource('LoginLog','LoginLogController');
Route::resource('IPs','IPsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
