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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Seeder
Route::post('/admin', 'App\Http\Controllers\UserController@Seeder');// done
//login
Route::post('/login', 'App\Http\Controllers\AuthController@login');// done
// crud user 
Route::get('/users', 'App\Http\Controllers\UserController@index'); // done
Route::post('/users', 'App\Http\Controllers\UserController@store'); //done 
Route::put('/users/{id}', 'App\Http\Controllers\UserController@update'); // done
Route::delete('/users/{id}', 'App\Http\Controllers\UserController@destroy'); // done

// car 
Route::get('/cars', 'App\Http\Controllers\CarController@index'); // done
Route::get('/price', 'App\Http\Controllers\CarController@estimatePrice'); // done

