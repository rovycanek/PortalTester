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
Route::resource('/pokus','TestsController');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');


use App\Mail\TestResults;

Route::get('/email', function(){
    return new TestResults('toto je titulek');

});





Auth::routes();

Route::resource('IPs','IPsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
