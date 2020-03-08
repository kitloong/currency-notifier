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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('currency-profiles', 'Api\CurrencyProfileController@index');
Route::get('currency-profiles/{currencyProfile}', 'Api\CurrencyProfileController@show');
Route::post('currency-profiles', 'Api\CurrencyProfileController@store');
Route::put('currency-profiles/{currencyProfile}', 'Api\CurrencyProfileController@update');
Route::delete('currency-profiles/{currencyProfile}', 'Api\CurrencyProfileController@destroy');
