<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\FareController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeatAllocationController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Only For Admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('bus', BusController::class);
    Route::resource('location', LocationController::class);
    Route::resource('trip', TripController::class);
    Route::resource('fare', FareController::class);
});

// Only For Passenger
Route::middleware(['auth', 'isPassenger'])->group(function () {
    Route::resource('book', SeatAllocationController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
