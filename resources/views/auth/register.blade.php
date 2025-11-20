<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <h2 class="text-center mb-1" style="color: #1f2937; font-weight: 700; font-size: 2rem;">Create Account</h2>
        <p class="text-center mb-6" style="color: #6b7280;">Sign up to get started</p>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <x-label for="name" value="{{ __('Full Name') }}" />
                <div class="relative">
                    <i class="fas fa-user absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                    <x-input id="name" class="block mt-1 w-full pl-10" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" style="padding-left: 2.5rem;" />
                </div>
            </div>

            <div class="mb-4">
                <x-label for="email" value="{{ __('Email Address') }}" />
                <div class="relative">
                    <i class="fas fa-envelope absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                    <x-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autocomplete="username" style="padding-left: 2.5rem;" />
                </div>
            </div>
            
            <div class="mb-4">
                <x-label for="phone" value="{{ __('Phone Number') }}" />
                <div class="relative">
                    <i class="fas fa-phone absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                    <x-input id="phone" class="block mt-1 w-full pl-10" type="text" name="phone" :value="old('phone')" autocomplete="phone" style="padding-left: 2.5rem;" />
                </div>
            </div>

            <div class="mb-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <i class="fas fa-lock absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                    <x-input id="password" class="block mt-1 w-full pl-10" type="password" name="password" required autocomplete="new-password" style="padding-left: 2.5rem;" />
                </div>
            </div>

            <div class="mb-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <div class="relative">
                    <i class="fas fa-lock absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                    <x-input id="password_confirmation" class="block mt-1 w-full pl-10" type="password" name="password_confirmation" required autocomplete="new-password" style="padding-left: 2.5rem;" />
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2 text-sm text-gray-600">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-blue-600 hover:text-blue-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-blue-600 hover:text-blue-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <x-button class="w-100" style="width: 100%; background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); border: none; padding: 0.75rem; font-weight: 600; border-radius: 8px;">
                <i class="fas fa-user-plus me-2"></i>{{ __('Register') }}
            </x-button>
            
            <div class="text-center mt-4">
                <span class="text-sm text-gray-600">Already have an account? </span>
                <a class="text-sm text-blue-600 hover:text-blue-800 font-weight-600" href="{{ route('login') }}">
                    {{ __('Login here') }}
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
