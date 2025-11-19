<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedRegisterResponse implements RegisterResponse
{
    public function toResponse($request): RedirectResponse
    {
        // Logout the user immediately after registration
        Auth::logout();
        
        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Registration successful! Please login with your credentials.');
    }
}

