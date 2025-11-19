<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Luxury Hotel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --dark-color: #1f2937;
            --light-color: #f9fafb;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }
        
        .register-left {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 600px;
        }
        
        .register-right {
            padding: 3rem;
        }
        
        .register-logo {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }
        
        .register-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }
        
        .register-subtitle {
            color: #6b7280;
            margin-bottom: 2rem;
        }
        
        .form-control {
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .input-group {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            z-index: 10;
        }
        
        .password-toggle:hover {
            color: var(--primary-color);
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }
        
        .alert {
            border-radius: 10px;
        }
        
        .text-danger {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="row g-0">
            <div class="col-lg-5 register-left d-none d-lg-block">
                <div>
                    <div class="register-logo">
                        <i class="fas fa-hotel"></i> Luxury Hotel
                    </div>
                    <h2 class="mb-3">Join Us Today!</h2>
                    <p class="mb-4">Create your account and start booking your perfect stay with exclusive benefits.</p>
                    <div class="mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle me-3 fs-5"></i>
                            <span>Easy booking management</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle me-3 fs-5"></i>
                            <span>Special member discounts</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle me-3 fs-5"></i>
                            <span>Priority customer support</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 fs-5"></i>
                            <span>Exclusive offers & deals</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 register-right">
                <div class="register-title">Create Account</div>
                <p class="register-subtitle">Fill in your details to get started</p>
                
                @include('components.toast')
                
                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name *</label>
                        <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your full name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address *</label>
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email">
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input id="phone" class="form-control" type="text" name="phone" :value="old('phone')" autocomplete="phone" placeholder="Enter your phone (optional)">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <div class="input-group">
                            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Enter your password">
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="password-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password *</label>
                        <div class="input-group">
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye" id="password_confirmation-eye"></i>
                            </button>
                        </div>
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="terms" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="{{ route('terms.show') }}" target="_blank" class="text-decoration-none">Terms of Service</a> and <a href="{{ route('policy.show') }}" target="_blank" class="text-decoration-none">Privacy Policy</a>
                            </label>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </button>
                    
                    <div class="text-center mt-4">
                        <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Sign in here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(inputId + '-eye');
            
            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        }
        
        // Initialize toasts
        document.addEventListener('DOMContentLoaded', function() {
            const toastElements = document.querySelectorAll('.toast');
            toastElements.forEach(function(toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            });
        });
    </script>
</body>
</html>
