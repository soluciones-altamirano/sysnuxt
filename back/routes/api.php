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

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('auth/me', 'AuthApiController@local');
    Route::get('oauth/me', 'AuthApiController@oauth');



    Route::resource('users', 'UserAPIController');
    Route::post('users/menu/store/{user}', 'UserAPIController@storeMenu');

    Route::resource('empresas', 'EmpresaAPIController');


    Route::resource('sucursales', 'SucursalAPIController');

    Route::resource('options', 'OptionAPIController');

});

