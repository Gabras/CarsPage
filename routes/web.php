<?php

use App\Http\Controllers\VehicleController;
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

Route::get('/', [VehicleController::class, 'index']);
Route::get('/vehicles/create', [VehicleController::class, 'create']);
Route::post('/vehicles/create', [VehicleController::class, 'store']);
Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit']);
Route::put('/vehicles/{id}/edit', [VehicleController::class, 'update'])->name('vehicle.update');





//Route::get('/', function () {
//    return view('home');
//});

//Route::get('/products', [ProductController::class, 'index']);
