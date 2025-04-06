@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="card-header">
            <h3>{{ __('Welcome Back') }}</h3>
            <p class="subtitle">Please login to your account</p>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-floating mb-4">
                    <input id="email" type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="email" 
                        placeholder="name@example.com"
                        autofocus>
                    <label for="email">{{ __('Email Address') }}</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                        placeholder="Password">
                    <label for="password">{{ __('Password') }}</label>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </button>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
{{-- 
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div> --}}

                <div class="d-flex align-items-center justify-content-between mb-2">
                    @if (Route::has('password.request'))
                        <a class="small text-decoration-none" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-sign-in-alt me-2"></i>{{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
        
        <div class="card-footer">
            @if (Route::has('register'))
                <p class="mb-0">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-decoration-none">
                        <span>Sign up</span> <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </p>
            @endif
        </div>
    </div>
</div>

<style>
.login-container {
    min-height: calc(100vh - 80px); /* Match navbar height from app.blade.php */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background-color: #f8f9fa; /* Match body background from app.blade.php */
}

.login-card {
    background: white;
    width: 100%;
    max-width: 450px;
    border-radius: 1rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.login-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(37, 99, 235, 0.15);
}

.card-header {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: white;
    padding: 2.5rem 2rem;
    text-align: center;
}

.card-header h3 {
    margin: 0;
    font-family: 'Outfit', sans-serif;
    font-weight: 600;
    font-size: 1.75rem;
}

.card-header .subtitle {
    margin: 0.5rem 0 0;
    opacity: 0.9;
    font-family: 'Inter', sans-serif;
}

.card-body {
    padding: 2.5rem 2rem;
}

.card-footer {
    background-color: #f8f9fa;
    padding: 1.5rem;
    text-align: center;
    border-top: 1px solid #e5e7eb;
}

.form-floating {
    position: relative;
}

.form-floating > .form-control {
    border: 2px solid #e5e7eb;
    border-radius: 0.5rem;
    padding: 1rem 0.75rem;
    height: calc(3.5rem + 2px);
    line-height: 1.25;
}

.form-floating > .form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
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
    color: #2563eb;
}

.btn-primary {
    background-color: #2563eb;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}

.form-check-input {
    width: 1.25rem;
    height: 1.25rem;
    margin-top: 0.1rem;
    border: 2px solid #d1d5db;
}

.form-check-input:checked {
    background-color: #2563eb;
    border-color: #2563eb;
}

.form-check-label {
    padding-left: 0.25rem;
}

a {
    color: #2563eb;
    font-weight: 500;
    transition: color 0.3s ease;
}

a:hover {
    color: #1d4ed8;
}

@media (max-width: 640px) {
    .login-container {
        padding: 1rem;
    }
    
    .card-header {
        padding: 2rem 1.5rem;
    }
    
    .card-body {
        padding: 2rem 1.5rem;
    }
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.login-card {
    animation: fadeIn 0.5s ease-out forwards;
}
</style>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const icon = document.querySelector('.password-toggle i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endsection