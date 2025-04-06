@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 fw-bold">Edit Profile</h2>
                <a href="{{ route('profile.view') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Profile
                </a>
            </div>
            
            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <!-- Form Card -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-4">
                            <!-- Current Profile Image -->
                            <div class="col-md-3 text-center mb-3 mb-md-0">
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset('storage/user_img/' . $user->img) }}" 
                                         alt="Current Image" 
                                         class="rounded-circle img-thumbnail" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                                <div class="mt-3">
                                    <label for="img" class="form-label fw-medium">Change Profile Image</label>
                                    <input type="file" name="img" id="img" class="form-control form-control-sm">
                                </div>
                            </div>
                            
                            <!-- Basic Information -->
                            <div class="col-md-9">
                                <h5 class="mb-3 fw-bold">Basic Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" id="username" name="username" class="form-control" 
                                                   value="{{ old('username', $account->username) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact" class="form-label">Contact</label>
                                            <input type="text" id="contact" name="contact" class="form-control" 
                                                   value="{{ old('contact', $user->contact) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname" class="form-label">First Name</label>
                                            <input type="text" id="fname" name="fname" class="form-control" 
                                                   value="{{ old('fname', $user->fname) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lname" class="form-label">Last Name</label>
                                            <input type="text" id="lname" name="lname" class="form-control" 
                                                   value="{{ old('lname', $user->lname) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="number" id="age" name="age" class="form-control" 
                                                   value="{{ old('age', $user->age) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select id="gender" name="gender" class="form-select" required>
                                                <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea id="address" name="address" class="form-control" rows="3" required>{{ old('address', $user->address) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Change Password Section -->
                        <div class="mt-4">
                            <h5 class="mb-3 fw-bold">Change Password <span class="text-muted fw-normal fs-6">(optional)</span></h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-label">New Password</label>
                                        <input type="password" id="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                            <a href="{{ route('profile.view') }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection