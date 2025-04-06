@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title mb-0">Edit Profile</h3>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Profile Image Section -->
                            <div class="col-12 mb-4 text-center">
                                <div class="profile-image-container">
                                    <img src="{{ asset('storage/user_img/' . $user->img) }}" 
                                         alt="Profile Image" 
                                         class="profile-image mb-3">
                                    <div class="image-upload-wrapper">
                                        <label for="img" class="image-upload-label">
                                            <i class="fas fa-camera me-2"></i>Change Photo
                                        </label>
                                        <input type="file" name="img" id="img" class="image-upload-input">
                                    </div>
                                </div>
                            </div>

                            <!-- Account Information -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username', $account->username) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $account->email) }}" required>
                            </div>

                            <!-- Personal Information -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="fname" class="form-control" value="{{ old('fname', $user->fname) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lname" class="form-control" value="{{ old('lname', $user->lname) }}" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" value="{{ old('age', $user->age) }}" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Contact</label>
                                <input type="text" name="contact" class="form-control" value="{{ old('contact', $user->contact) }}" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="3" required>{{ old('address', $user->address) }}</textarea>
                            </div>

                            <!-- Password Change Section -->
                            <div class="col-12 mt-4">
                                <h5 class="border-bottom pb-2">Change Password (optional)</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('profile.view') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 10px;
    border: none;
}

.card-header {
    border-bottom: 1px solid #eee;
}

.card-title {
    font-family: 'Outfit', sans-serif;
    font-weight: 600;
    color: #2563eb;
}

.profile-image-container {
    display: inline-block;
}

.profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.image-upload-wrapper {
    position: relative;
    margin-top: 10px;
}

.image-upload-label {
    display: inline-block;
    padding: 8px 16px;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.image-upload-label:hover {
    background-color: #e9ecef;
}

.image-upload-input {
    display: none;
}

.form-label {
    font-weight: 500;
    color: #4b5563;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 0.625rem 0.75rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
}

textarea.form-control {
    resize: vertical;
}

.btn {
    padding: 0.625rem 1.25rem;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #2563eb;
    border-color: #2563eb;
}

.btn-primary:hover {
    background-color: #1d4ed8;
    border-color: #1d4ed8;
    transform: translateY(-1px);
}

.btn-light {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.btn-light:hover {
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.alert {
    border-radius: 8px;
    border: none;
}

.alert-success {
    background-color: #ecfdf5;
    color: #047857;
}

@media (max-width: 768px) {
    .profile-image {
        width: 120px;
        height: 120px;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .d-flex.justify-content-end {
        flex-direction: column-reverse;
    }
}
</style>
@endsection