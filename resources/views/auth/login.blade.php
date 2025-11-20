<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <h2 class="text-center mb-1" style="color: #1f2937; font-weight: 700; font-size: 2rem;">Welcome Back</h2>
        <p class="text-center mb-6" style="color: #6b7280;">Sign in to your account</p>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg">
                <i class="fas fa-check-circle me-2"></i>{{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <x-label for="email" value="{{ __('Email Address') }}" />
                <div class="relative">
                    <i class="fas fa-envelope absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                    <x-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="padding-left: 2.5rem;" />
                </div>
            </div>

            <div class="mb-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <i class="fas fa-lock absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                    <x-input id="password" class="block mt-1 w-full pl-10" type="password" name="password" required autocomplete="current-password" style="padding-left: 2.5rem;" />
                </div>
            </div>

            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-button class="w-100" style="width: 100%; background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border: none; padding: 0.75rem; font-weight: 600; border-radius: 8px;">
                <i class="fas fa-sign-in-alt me-2"></i>{{ __('Log in') }}
            </x-button>
            
            <div class="text-center mt-4">
                <span class="text-sm text-gray-600">Don't have an account? </span>
                <a class="text-sm text-blue-600 hover:text-blue-800 font-weight-600" href="{{ route('register') }}">
                    {{ __('Register here') }}
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
