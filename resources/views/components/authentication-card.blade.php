<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem 1rem;">
    <div class="mb-4">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-2xl" style="border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
        {{ $slot }}
    </div>
    
    <div class="mt-6 text-center">
        <a href="{{ route('homepage') }}" class="text-white hover:text-gray-200 transition-colors" style="text-decoration: none;">
            <i class="fas fa-arrow-left me-2"></i>Back to Home
        </a>
    </div>
</div>
