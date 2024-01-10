<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('web/users', [App\Http\Controllers\UserController::class, 'index']);
// Route::get('/users', [App\Http\Controllers\UserController::class, 'store']);
Route::get('web/users/{id}', [App\Http\Controllers\UserController::class, 'show']);
// Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit']);
// Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('web/users/{id}', [App\Http\Controllers\UserController::class, 'destroy']);


// vehicles routes
Route::get('web/vehicles', [App\Http\Controllers\VehicleController::class, 'index']);
Route::post('web/vehicles', [App\Http\Controllers\VehicleController::class, 'store']);
Route::get('web/vehicles/{id}', [App\Http\Controllers\VehicleController::class, 'show']);
// Route::get('/vehicles/{id}/edit', [App\Http\Controllers\VehicleController::class, 'edit']);
// Route::get('/vehicles/{id}', [App\Http\Controllers\VehicleController::class, 'update']);
Route::delete('web/vehicles/{id}', [App\Http\Controllers\VehicleController::class, 'destroy']);
Route::post('/web/vehicles/{vehicleId}/park/{garageId}', [App\Http\Controllers\VehicleController::class, 'parkVehicle']);
Route::post('/web/vehicles/{vehicleId}/removeVehicleFromGarage/{garageId}', [App\Http\Controllers\VehicleController::class, 'removeVehicleFromGarage']);


// garage routes
Route::get('web/garages', [App\Http\Controllers\GarageController::class, 'index']);
Route::post('web/garages', [App\Http\Controllers\GarageController::class, 'store']);
Route::get('web/garages/{id}', [App\Http\Controllers\GarageController::class, 'show']);
// Route::get('/garages/{id}/edit', [App\Http\Controllers\GarageController::class, 'edit']);
// Route::get('/garages/{id}', [App\Http\Controllers\GarageController::class, 'update']);
Route::delete('web/garages/{id}', [App\Http\Controllers\GarageController::class, 'destroy']);

// parking_history routes
Route::get('web/parking-history', [App\Http\Controllers\ParkingHistoryController::class, 'index']);
Route::get('web/vehicle-parking-history/{id}', [App\Http\Controllers\ParkingHistoryController::class, 'show']);


require __DIR__.'/auth.php';
