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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','api\apiController@register');
Route::post('/login','api\apiController@login');
Route::post('/logout','api\apiController@logout');
Route::post('/emploi','api\apiController@emploi');
Route::post('/justification','api\apiController@justification');
Route::post('/qrcode','api\apiController@qrcode');
Route::post('/changePassword','api\apiController@changePassword');