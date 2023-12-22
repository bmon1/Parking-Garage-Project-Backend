<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
// Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create']);
// Route::get('/users', [App\Http\Controllers\UserController::class, 'store']);
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show']);
// Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit']);
// Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy']);


// vehicles routes
Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'index']);
// Route::get('/vehicles/create', [App\Http\Controllers\VehicleController::class, 'create']);
// Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'store']);
Route::get('/vehicles/{id}', [App\Http\Controllers\VehicleController::class, 'show']);
// Route::get('/vehicles/{id}/edit', [App\Http\Controllers\VehicleController::class, 'edit']);
// Route::get('/vehicles/{id}', [App\Http\Controllers\VehicleController::class, 'update']);
Route::delete('/vehicles/{id}', [App\Http\Controllers\VehicleController::class, 'destroy']);

// garage routes
Route::get('/garages', [App\Http\Controllers\GarageController::class, 'index']);
// Route::get('/garages/create', [App\Http\Controllers\GarageController::class, 'create']);
// Route::get('/garages', [App\Http\Controllers\GarageController::class, 'store']);
Route::get('/garages/{id}', [App\Http\Controllers\GarageController::class, 'show']);
// Route::get('/garages/{id}/edit', [App\Http\Controllers\GarageController::class, 'edit']);
// Route::get('/garages/{id}', [App\Http\Controllers\GarageController::class, 'update']);
Route::delete('/garages/{id}', [App\Http\Controllers\GarageController::class, 'destroy']);