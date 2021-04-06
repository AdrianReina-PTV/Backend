<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//LLAMAMOS A LA FUNCION LOGIN CREADA EN LOGINCONTROLLER
Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');
