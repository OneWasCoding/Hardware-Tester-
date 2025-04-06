@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Profile Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0 fw-bold">Profile Information</h2>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Profile
                </a>
            </div>
            
            <!-- Profile Card -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Profile Image Column -->
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            <div class="mb-3">
                                <img src="{{ asset('storage/user_img/' . $user->img) }}" 
                                     alt="Profile Picture" 
                                     class="rounded-circle img-thumbnail" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <h5 class="fw-bold mb-0">{{ $user->fname }} {{ $user->lname }}</h5>
                            <p class="text-muted">{{ Auth::user()->username }}</p>
                        </div>
                        
                        <!-- Profile Info Column -->
                        <div class="col-md-9">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="text-muted small">Email</span>
                                        <p class="mb-3 fw-medium">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="text-muted small">Contact</span>
                                        <p class="mb-3 fw-medium">{{ $user->contact }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="text-muted small">Age</span>
                                        <p class="mb-3 fw-medium">{{ $user->age }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="text-muted small">Gender</span>
                                        <p class="mb-3 fw-medium">{{ ucfirst($user->gender) }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="profile-info-item">
                                        <span class="text-muted small">Address</span>
                                        <p class="mb-0 fw-medium">{{ $user->address ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-info-item {
        padding: 8px 0;
    }
    .profile-info-item span {
        display: block;
    }
</style>
@endsection