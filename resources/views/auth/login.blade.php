@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="card-header">
            <div class="logo-container">
                <i class="fas fa-tools logo-icon"></i>
            </div>
            <h3>{{ __('EnM Hardware') }}</h3>
            <p class="subtitle">Access your account tools</p>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-envelope input-icon"></i>
                        <input id="email" type="email" 
                            class="custom-input @error('email') is-invalid @enderror" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email" 
                            placeholder="Email Address"
                            autofocus>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input id="password" 
                            type="password" 
                            class="custom-input @error('password') is-invalid @enderror" 
                            name="password" 
                            required 
                            autocomplete="current-password" 
                            placeholder="Password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="forgot-password">
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    {{ __('Log In') }} <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </form>
        </div>
        
        <div class="card-footer">
            @if (Route::has('register'))
                <p class="register-text">Need an account? 
                    <a href="{{ route('register') }}" class="register-link">
                        <span>Create Account</span> <i class="fas fa-hammer ms-1"></i>
                    </a>
                </p>
            @endif
        </div>
    </div>
</div>

<style>
:root {
    --primary: #e65100;
    --primary-dark: #c94700;
    --primary-light: #ff8a50;
    --secondary: #455a64;
    --secondary-dark: #1c313a;
    --secondary-light: #718792;
    --light: #f5f5f5;
    --dark: #263238;
    --gray: #b0bec5;
    --error: #d32f2f;
    
    --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
    --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.12);
    --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.15);
    
    --transition: all 0.3s ease;
}

.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background-color: #f5f5f5;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23e0e0e0' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.login-card {
    background: white;
    width: 100%;
    max-width: 400px;
    border-radius: 8px;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    transition: var(--transition);
}

.login-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(38, 50, 56, 0.2);
}

.card-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    padding: 2rem;
    text-align: center;
    position: relative;
}

.card-header h3 {
    margin: 0.5rem 0;
    font-weight: 700;
    font-size: 1.75rem;
    letter-spacing: 0.5px;
}

.card-header .subtitle {
    margin: 0.25rem 0 0;
    opacity: 0.9;
    font-size: 0.95rem;
}

.logo-container {
    margin-bottom: 1rem;
}

.logo-icon {
    font-size: 3rem;
    color: white;
    background: rgba(255, 255, 255, 0.2);
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card-body {
    padding: 2rem;
}

.card-footer {
    background-color: #f8f9fa;
    padding: 1.5rem;
    text-align: center;
    border-top: 1px solid #e9ecef;
}

.form-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.input-with-icon {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary);
    font-size: 1rem;
}

.custom-input {
    width: 100%;
    padding: 0.75rem 0.75rem 0.75rem 2.75rem;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    background-color: #f9f9f9;
    font-size: 1rem;
    transition: var(--transition);
}

.custom-input:focus {
    outline: none;
    border-color: var(--primary);
    background-color: white;
    box-shadow: 0 0 0 3px rgba(230, 81, 0, 0.15);
}

.custom-input::placeholder {
    color: #9e9e9e;
}

.invalid-feedback {
    display: block;
    color: var(--error);
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

.forgot-password {
    text-align: right;
    margin-bottom: 1.5rem;
}

.forgot-link {
    color: var(--secondary);
    font-size: 0.85rem;
    text-decoration: none;
    transition: var(--transition);
}

.forgot-link:hover {
    color: var(--primary);
}

.btn-login {
    display: block;
    width: 100%;
    padding: 0.9rem;
    background-color: var(--primary);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 600;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.btn-login:hover {
    background-color: var(--primary-dark);
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.btn-login:active {
    transform: translateY(0);
}

.btn-login i {
    margin-left: 5px;
}

.register-text {
    margin: 0;
    color: var(--secondary);
    font-size: 0.95rem;
}

.register-link {
    color: var(--primary);
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
}

.register-link:hover {
    color: var(--primary-dark);
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

.login-card {
    animation: fadeIn 0.5s ease-out forwards;
}

/* Hardware-themed decorative elements */
.card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: repeating-linear-gradient(
        90deg,
        var(--primary-dark),
        var(--primary-dark) 15px,
        var(--primary-light) 15px,
        var(--primary-light) 30px
    );
}

.card-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 6px;
    background-image: linear-gradient(90deg, transparent, transparent 50%, var(--primary-light) 50%, var(--primary-light) 100%);
    background-size: 10px 10px;
    opacity: 0.3;
}

@media (max-width: 640px) {
    .login-container {
        padding: 1rem;
    }
    
    .login-card {
        max-width: 100%;
    }
    
    .card-header {
        padding: 1.5rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }

    .logo-icon {
        width: 60px;
        height: 60px;
        font-size: 2.5rem;
    }
}
</style>
@endsection