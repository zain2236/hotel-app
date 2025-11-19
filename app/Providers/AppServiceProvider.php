<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Explicitly set route model binding to use 'id' for bookings and rooms
        Route::bind('booking', function ($value) {
            return \App\Models\Booking::findOrFail($value);
        });
        
        Route::bind('room', function ($value) {
            return \App\Models\Room::findOrFail($value);
        });
        
        // Register custom Fortify response classes
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Actions\Fortify\AuthenticatedLoginResponse::class
        );
        
        $this->app->singleton(
            \Laravel\Fortify\Contracts\RegisterResponse::class,
            \App\Actions\Fortify\AuthenticatedRegisterResponse::class
        );
    }
}
