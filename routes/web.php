<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

// Public routes
Route::get('/', [AdminController::class, 'home'])->name('homepage');
Route::get('/rooms', [RoomController::class, 'publicIndex'])->name('rooms.public');

// Room detail and booking
Route::get('/room/{id}', [RoomController::class, 'show'])->name('room.show');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');
Route::get('/booking/success', [BookingController::class, 'success'])->name('bookings.success');

// Authentication routes are handled by Jetstream

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    
    // User booking routes
    Route::prefix('my-bookings')->name('user.')->group(function () {
        Route::get('/', [App\Http\Controllers\UserBookingController::class, 'index'])->name('bookings.index');
        Route::get('/{id}', [App\Http\Controllers\UserBookingController::class, 'show'])->name('bookings.show');
        Route::put('/{id}', [App\Http\Controllers\UserBookingController::class, 'update'])->name('bookings.update');
        Route::delete('/{id}', [App\Http\Controllers\UserBookingController::class, 'destroy'])->name('bookings.destroy');
    });
    
    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        // Rooms CRUD
        Route::resource('rooms', RoomController::class);
        
        // Bookings CRUD
        Route::resource('bookings', BookingController::class);
    });
});
