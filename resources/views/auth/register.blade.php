@extends('layouts.app')

@section('content')
<div class="register-container">
    <div class="register-card">
        <div class="card-header">
            <div class="logo-container">
                <i class="fas fa-tools logo-icon"></i>
            </div>
            <h3>{{ __('Join EnM Hardware') }}</h3>
            <p class="subtitle">Build your account with us</p>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="section-title">
                    <i class="fas fa-user-hard-hat"></i>
                    <span>Personal Information</span>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <div class="form-group">
                            <div class="input-with-icon">
                                <i class="fas fa-id-card input-icon"></i>
                                <input id="fname" type="text" 
                                    class="custom-input @error('fname') is-invalid @enderror" 
                                    name="fname" 
                                    value="{{ old('fname') }}" 
                                    autocomplete="fname" 
                                    placeholder="First Name" 
                                    autofocus>
                            </div>
                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="form-group">
                            <div class="input-with-icon">
                                <i class="fas fa-id-card input-icon"></i>
                                <input id="lname" type="text" 
                                    class="custom-input @error('lname') is-invalid @enderror" 
                                    name="lname" 
                                    value="{{ old('lname') }}" 
                                    autocomplete="lname" 
                                    placeholder="Last Name">
                            </div>
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <div class="form-group">
                            <div class="input-with-icon">
                                <i class="fas fa-birthday-cake input-icon"></i>
                                <input id="age" type="number" 
                                    class="custom-input @error('age') is-invalid @enderror" 
                                    name="age" 
                                    value="{{ old('age') }}" 
                                    min="18" 
                                    placeholder="Age">
                            </div>
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="form-group">
                            <div class="select-wrapper">
                                <i class="fas fa-venus-mars input-icon"></i>
                                <select id="gender" 
                                    class="custom-select @error('gender') is-invalid @enderror" 
                                    name="gender">
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Sex</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="section-title">
                    <i class="fas fa-address-book"></i>
                    <span>Contact Details</span>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-phone input-icon"></i>
                        <input id="contact" type="text" 
                            class="custom-input @error('contact') is-invalid @enderror" 
                            name="contact" 
                            value="{{ old('contact') }}" 
                            maxlength="11" 
                            placeholder="Contact Number">
                    </div>
                    @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-with-icon textarea-icon">
                        <i class="fas fa-map-marker-alt input-icon"></i>
                        <textarea id="address" 
                            class="custom-textarea @error('address') is-invalid @enderror" 
                            name="address" 
                            placeholder="Delivery Address">{{ old('address') }}</textarea>
                    </div>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="section-title">
                    <i class="fas fa-user-lock"></i>
                    <span>Account Information</span>
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-envelope input-icon"></i>
                        <input id="email" type="email" 
                            class="custom-input @error('email') is-invalid @enderror" 
                            name="email" 
                            value="{{ old('email') }}" 
                            autocomplete="email" 
                            placeholder="Email Address">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-user input-icon"></i>
                        <input id="username" type="text" 
                            class="custom-input @error('username') is-invalid @enderror" 
                            name="username" 
                            value="{{ old('username') }}" 
                            placeholder="Username">
                    </div>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input id="password" type="password" 
                            class="custom-input @error('password') is-invalid @enderror" 
                            name="password" 
                            autocomplete="new-password" 
                            placeholder="Password">
                        <label class="password-toggle" for="show_password">
                            <input type="checkbox" id="show_password" class="password-checkbox">
                            <i class="fas fa-eye"></i>
                        </label>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-lock input-icon"></i>
                        <input id="password-confirm" type="password" 
                            class="custom-input" 
                            name="password_confirmation" 
                            autocomplete="new-password" 
                            placeholder="Confirm Password">
                        <label class="password-toggle" for="show_password_confirm">
                            <input type="checkbox" id="show_password_confirm" class="password-checkbox">
                            <i class="fas fa-eye"></i>
                        </label>
                    </div>
                </div>

                <div class="section-title">
                    <i class="fas fa-camera"></i>
                    <span>Profile Picture</span>
                </div>

                <div class="profile-upload">
                    <label for="profile_picture" class="profile-upload-label">
                        <div class="preview-container">
                            <img id="preview" src="/api/placeholder/150/150" alt="Profile Preview" class="preview-image d-none">
                            <div id="upload-placeholder" class="upload-placeholder">
                                <i class="fas fa-user-hard-hat"></i>
                                <span>Add Photo</span>
                            </div>
                        </div>
                        <input id="profile_picture" 
                            type="file" 
                            class="file-input @error('profile_picture') is-invalid @enderror" 
                            name="profile_picture" 
                            accept="image/*">
                    </label>
                    @error('profile_picture')
                        <span class="invalid-feedback text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-hammer me-2"></i>{{ __('Build My Account') }}
                </button>
                
                <div class="login-link">
                    <p>Already have an account? 
                        <a href="{{ route('login') }}">
                            <span>Login</span> <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </p>
                </div>
            </form>
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

/* Base Styles */
.register-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background-color: #f5f5f5;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23e0e0e0' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.register-card {
    background: white;
    width: 100%;
    max-width: 800px;
    border-radius: 8px;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    margin: 2rem 0;
    transition: var(--transition);
}

.register-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(38, 50, 56, 0.2);
}

/* Card Header */
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

/* Card Body */
.card-body {
    padding: 2rem;
}

/* Section Titles */
.section-title {
    display: flex;
    align-items: center;
    margin: 1.5rem 0 1rem;
    color: var(--secondary-dark);
    font-weight: 600;
    font-size: 1.1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #eee;
}

.section-title i {
    margin-right: 0.75rem;
    color: var(--primary);
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
}

/* Form Layout */
.form-row {
    display: flex;
    margin: 0 -0.75rem;
}

.form-column {
    flex: 1;
    padding: 0 0.75rem;
}

.form-group {
    margin-bottom: 1.25rem;
    position: relative;
}

/* Input Styling */
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
    z-index: 2;
}

.textarea-icon .input-icon {
    top: 20px;
    transform: none;
}

.custom-input, .custom-textarea, .custom-select {
    width: 100%;
    padding: 0.75rem 0.75rem 0.75rem 2.75rem;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    background-color: #f9f9f9;
    font-size: 1rem;
    transition: var(--transition);
    color: var(--dark);
}

.custom-input:focus, .custom-textarea:focus, .custom-select:focus {
    outline: none;
    border-color: var(--primary);
    background-color: white;
    box-shadow: 0 0 0 3px rgba(230, 81, 0, 0.15);
}

.custom-input::placeholder, .custom-textarea::placeholder {
    color: #9e9e9e;
}

.custom-textarea {
    height: 100px;
    resize: none;
}

/* Select Styling */
.select-wrapper {
    position: relative;
}

.custom-select {
    appearance: none;
    padding-right: 2rem;
    cursor: pointer;
}

.select-wrapper:after {
    content: '\f078';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary);
    pointer-events: none;
}

/* Password Toggle Styling */
.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary);
    cursor: pointer;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
}

.password-checkbox {
    display: none;
}

.password-checkbox:checked + i:before {
    content: '\f070'; /* fa-eye-slash */
}

/* Profile Upload Styling */
.profile-upload {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 1.5rem 0;
}

.profile-upload-label {
    cursor: pointer;
    display: block;
    text-align: center;
}

.preview-container {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 3px solid #e0e0e0;
    overflow: hidden;
    margin: 0 auto 1rem;
    position: relative;
    background-color: #f9f9f9;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.preview-container:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-md);
}

.upload-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: var(--gray);
}

.upload-placeholder i {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.upload-placeholder span {
    font-size: 0.85rem;
    font-weight: 500;
}

.preview-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.file-input {
    position: absolute;
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    z-index: -1;
}

/* Button Styling */
.btn-register {
    display: block;
    width: 100%;
    padding: 1rem;
    background-color: var(--primary);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 1.1rem;
    font-weight: 600;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    margin-top: 2rem;
}

.btn-register:hover {
    background-color: var(--primary-dark);
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.btn-register:active {
    transform: translateY(0);
}

.btn-register i {
    margin-right: 0.5rem;
}

/* Login Link */
.login-link {
    text-align: center;
    margin-top: 1.5rem;
}

.login-link p {
    margin: 0;
    color: var(--secondary);
}

.login-link a {
    color: var(--primary);
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
}

.login-link a:hover {
    color: var(--primary-dark);
}

/* Validation Styling */
.invalid-feedback {
    display: block;
    color: var(--error);
    font-size: 0.85rem;
    margin-top: 0.375rem;
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

.register-card {
    animation: fadeIn 0.5s ease-out forwards;
}

/* Hardware-themed elements */
.d-none {
    display: none !important;
}

/* CSS-only password toggle */
#show_password:checked ~ .fa-eye:before {
    content: "\f070";
}

#show_password_confirm:checked ~ .fa-eye:before {
    content: "\f070";
}

/* Profile picture preview */
input[type="file"]:focus + .preview-container {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(230, 81, 0, 0.15);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .register-container {
        padding: 1rem;
    }
    
    .register-card {
        margin: 1rem 0;
    }
    
    .card-header {
        padding: 1.5rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .form-row {
        flex-direction: column;
        margin: 0;
    }
    
    .form-column {
        padding: 0;
    }
    
    .logo-icon {
        width: 60px;
        height: 60px;
        font-size: 2.5rem;
    }
}
</style>

<!-- Pure CSS solution for form functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show/hide password with CSS only toggle
    const showPasswordCheckbox = document.getElementById('show_password');
    const passwordInput = document.getElementById('password');
    
    showPasswordCheckbox.addEventListener('change', function() {
        passwordInput.type = this.checked ? 'text' : 'password';
    });
    
    // Show/hide confirm password with CSS only toggle
    const showPasswordConfirmCheckbox = document.getElementById('show_password_confirm');
    const passwordConfirmInput = document.getElementById('password-confirm');
    
    showPasswordConfirmCheckbox.addEventListener('change', function() {
        passwordConfirmInput.type = this.checked ? 'text' : 'password';
    });
    
    // Preview profile picture
    const profilePicture = document.getElementById('profile_picture');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('upload-placeholder');
    
    profilePicture.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                placeholder.classList.add('d-none');
            }
            
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.classList.add('d-none');
            placeholder.classList.remove('d-none');
        }
    });
});
</script>
@endsection