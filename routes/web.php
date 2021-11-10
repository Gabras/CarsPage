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

Route::get('/', [\App\Http\Controllers\VehicleController::class, 'index']);
Route::get('/vehicles/create', [\App\Http\Controllers\VehicleController::class, 'create']);
Route::post('/vehicles/create', [\App\Http\Controllers\VehicleController::class, 'store']);




//Route::get('/', function () {
//    return view('home');
//});

//Route::get('/products', [ProductController::class, 'index']);
