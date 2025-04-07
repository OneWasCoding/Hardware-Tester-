@extends('layouts.app')

@section('content')
<div class="register-container">
    <div class="register-card">
        <div class="card-header">
            <h3>{{ __('Create Account') }}</h3>
            <p class="subtitle">Join Keyboard Haven today</p>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}"    autocomplete="fname" placeholder="First Name" autofocus>
                            <label for="fname">{{ __('First Name') }}</label>
                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}"  autocomplete="lname" placeholder="Last Name">
                            <label for="lname">{{ __('Last Name') }}</label>
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}"   min="18" placeholder="Age">
                            <label for="age">{{ __('Age') }}</label>
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <select id="gender" class="form-select @error('gender') is-invalid @enderror" name="gender"    aria-label="Gender">
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            {{-- <label for="gender">{{ __('Gender') }}</label> --}}
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}"    maxlength="11" placeholder="Contact Number">
                        <label for="contact">{{ __('Contact Number') }}</label>
                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" style="height: 100px"   >{{ old('address') }}</textarea>
                        <label for="address">{{ __('Address') }}</label>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"    autocomplete="email" placeholder="Email Address">
                        <label for="email">{{ __('Email Address') }}</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"    placeholder="Username">
                        <label for="username">{{ __('Username') }}</label>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"    autocomplete="new-password" placeholder="Password">
                        <label for="password">{{ __('Password') }}</label>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"    autocomplete="new-password" placeholder="Confirm Password">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <button type="button" class="password-toggle" onclick="togglePassword('password-confirm')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="profile_picture" class="form-label">{{ __('Profile Picture') }}</label>
                    <div class="profile-upload">
                        <div class="preview-container mb-2">
                            <img id="preview" src="/api/placeholder/150/150" alt="Profile Preview" class="preview-image d-none">
                            <div id="upload-placeholder" class="upload-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="custom-file-upload">
                            <input id="profile_picture" type="file" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture" accept="image/*" onchange="previewImage(this)">
                            <label for="profile_picture" class="file-upload-btn">
                                <i class="fas fa-upload me-2"></i>Choose Image
                            </label>
                        </div>
                        @error('profile_picture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus me-2"></i>{{ __('Create Account') }}
                    </button>
                </div>
                
                <div class="text-center mt-3">
                    <p class="mb-0">Already have an account? 
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <span>Login</span> <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.register-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background-color: #f8f9fa;
}

.register-card {
    background: white;
    width: 100%;
    max-width: 900px;
    border-radius: 1rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin: 2rem 0;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.register-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(37, 99, 235, 0.15);
}

.card-header {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    color: white;
    padding: 2rem;
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
    padding: 2.5rem;
}

.form-floating {
    position: relative;
    margin-bottom: 1rem;
}

.form-floating > .form-control,
.form-floating > .form-select {
    border: 2px solid #e5e7eb;
    border-radius: 0.5rem;
    height: calc(3.5rem + 2px);
    padding: 1rem 0.75rem;
}

.form-floating > textarea.form-control {
    height: 100px;
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus {
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

.profile-upload {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.preview-container {
    width: 150px;
    height: 150px;
    overflow: hidden;
    border-radius: 50%;
    border: 3px solid #e5e7eb;
    position: relative;
    background-color: #f3f4f6;
    transition: all 0.3s ease;
}

.preview-container:hover {
    border-color: #2563eb;
}

.preview-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.upload-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    font-size: 50px;
    color: #d1d5db;
}

.file-upload-btn {
    background-color: #f3f4f6;
    color: #4b5563;
    border: 2px solid #e5e7eb;
    border-radius: 0.5rem;
    padding: 0.75rem 1.5rem;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-block;
    margin-top: 1rem;
}

.file-upload-btn:hover {
    background-color: #e5e7eb;
    color: #2563eb;
}

#profile_picture {
    opacity: 0;
    position: absolute;
    z-index: -1;
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

.form-check-input:checked {
    background-color: #2563eb;
    border-color: #2563eb;
}

a {
    color: #2563eb;
    font-weight: 500;
    transition: color 0.3s ease;
}

a:hover {
    color: #1d4ed8;
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.register-card {
    animation: fadeIn 0.5s ease-out forwards;
}

@media (max-width: 768px) {
    .register-container {
        padding: 1rem;
    }
    
    .card-header {
        padding: 1.5rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
}
</style>

<script>
function togglePassword(id) {
    const passwordInput = document.getElementById(id);
    const icon = document.querySelector(`#${id}`).nextElementSibling.querySelector('i');
    
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

function previewImage(input) {
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('upload-placeholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            placeholder.classList.add('d-none');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('d-none');
        placeholder.classList.remove('d-none');
    }
}
</script>
@endsection