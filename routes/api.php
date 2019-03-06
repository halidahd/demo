<?php

use Illuminate\Http\Request;

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

Route::post('login', 'UserController@login')->name('api.login');
Route::post('user/register', 'UserController@register')->name('user-register');

Route::middleware('auth:api')->group(function () {
    Route::put('user/update', 'UserController@update')->name('user-update');
});
