<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

// Public routes
Route::get('/', [AdminController::class, 'home'])->name('homepage');
Route::get('/rooms', [RoomController::class, 'publicIndex'])->name('rooms.public');
Route::post('/contact', [AdminController::class, 'contact'])->name('contact.send');

// Room detail and booking (must be before admin routes to avoid conflicts)
// Note: Using singular 'room' to avoid conflict with admin 'rooms'
Route::get('/room/{id}', [RoomController::class, 'show'])->name('room.show');

// Public booking creation route (for users to book rooms)
// IMPORTANT: This route name must be unique and different from admin routes
Route::post('/bookings', [BookingController::class, 'store'])->name('public.bookings.store')->middleware('auth');
Route::get('/booking/success', [BookingController::class, 'success'])->name('bookings.success');

// Authentication routes are handled by Jetstream

// Debug route (remove in production)
Route::get('/debug-admin', function() {
    $user = Auth::user();
    return [
        'logged_in' => Auth::check(),
        'user_id' => $user?->id,
        'usertype' => $user?->usertype,
        'is_admin' => $user && $user->usertype === 'admin',
    ];
})->middleware('auth');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    
    // Redirect GET /bookings to admin panel for admins (must be before admin routes)
    Route::get('/bookings', function() {
        if (Auth::user()->usertype === 'admin') {
            return redirect()->route('admin.bookings.index');
        }
        abort(404, 'Page not found. Please use the admin panel to view bookings.');
    });
    
    // Test route to verify admin access
    Route::get('/test-admin-routes', function() {
        $user = Auth::user();
        return response()->json([
            'status' => 'ok',
            'logged_in' => Auth::check(),
            'user_id' => $user?->id,
            'usertype' => $user?->usertype,
            'is_admin' => $user && $user->usertype === 'admin',
            'routes' => [
                'rooms_create' => route('admin.rooms.create'),
                'bookings_show' => route('admin.bookings.show', 1),
            ],
        ]);
    });
    
    // User booking routes
    Route::prefix('my-bookings')->name('user.')->group(function () {
        Route::get('/', [App\Http\Controllers\UserBookingController::class, 'index'])->name('bookings.index');
        Route::get('/{id}', [App\Http\Controllers\UserBookingController::class, 'show'])->name('bookings.show');
        Route::put('/{id}', [App\Http\Controllers\UserBookingController::class, 'update'])->name('bookings.update');
        Route::delete('/{id}', [App\Http\Controllers\UserBookingController::class, 'destroy'])->name('bookings.destroy');
    });
    
    // Admin routes - must be authenticated and have admin role
    // Note: Already inside auth middleware group, only need admin middleware
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        // Rooms CRUD - IMPORTANT: Specific routes (create/edit) must come before {id} routes
        Route::get('rooms', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('rooms/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('rooms', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::get('rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
        Route::put('rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');
        Route::patch('rooms/{id}', [RoomController::class, 'update']); // Support PATCH as well
        Route::delete('rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
        
        // Bookings CRUD - IMPORTANT: Specific routes (create/edit) must come before {id} routes
        // Order matters: index, create, store, edit, show, update, destroy
        Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::get('bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
        Route::put('bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
        Route::patch('bookings/{id}', [BookingController::class, 'update'])->name('bookings.update.patch'); // Support PATCH as well
        Route::delete('bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });
});
