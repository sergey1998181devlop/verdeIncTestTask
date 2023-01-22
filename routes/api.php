<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Agents\AuthAgentsController;

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
//Route::controller(AuthAgentsController::class)->group(function(){
//    Route::post('dashboard/login', 'login');
//});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/contact'
], function ($router) {
    Route::controller(AuthAgentsController::class)->group(function(){
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout');
        Route::post('/token', 'token');
        Route::post('/me', 'me');
        Route::post('/tokenid', 'tokenId');
    });
});
//Route::middleware('auth:agents')->group(function(){
//    Route::get('auth/register', 'AuthAgentsController@register');
//    Route::get('auth/login', 'AuthAgentsController@login');
//    Route::get('auth/logout', 'AuthAgentsController@logout');
//    Route::get('auth/token', 'AuthAgentsController@token');
//    Route::get('auth/me', 'AuthAgentsController@me');
//    Route::get('auth/tokenid', 'AuthAgentsController@tokenId');
//});
//Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
//    Route::get('login', 'AdminAuthController@getLogin')->name('login');
//    Route::post('login', 'AdminAuthController@postLogin');
//});
