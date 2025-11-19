<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse;
use Illuminate\Http\RedirectResponse;

class AuthenticatedLoginResponse implements LoginResponse
{
    public function toResponse($request): RedirectResponse
    {
        return redirect()->route('home')->with('success', 'Welcome back! You have successfully logged in.');
    }
}

