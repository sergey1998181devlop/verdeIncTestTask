<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Contacts\AuthContactsController;

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
//Route::controller(AuthContactsController::class)->group(function(){
//    Route::post('dashboard/login', 'login');
//});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth/contact'
], function ($router) {
    Route::controller(AuthContactsController::class)->group(function(){
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout');
        Route::post('/token', 'token');
        Route::post('/me', 'me');
        Route::post('/tokenid', 'tokenId');
    });
});
//Route::middleware('auth:contacts')->group(function(){
//    Route::get('auth/register', 'AuthContactsController@register');
//    Route::get('auth/login', 'AuthContactsController@login');
//    Route::get('auth/logout', 'AuthContactsController@logout');
//    Route::get('auth/token', 'AuthContactsController@token');
//    Route::get('auth/me', 'AuthContactsController@me');
//    Route::get('auth/tokenid', 'AuthContactsController@tokenId');
//});
//Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
//    Route::get('login', 'AdminAuthController@getLogin')->name('login');
//    Route::post('login', 'AdminAuthController@postLogin');
//});
