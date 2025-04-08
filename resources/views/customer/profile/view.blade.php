@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Profile Header with Hardware Store Theme -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-tools text-warning me-2" style="font-size: 24px;"></i>
                    <h2 class="mb-0 fw-bold">Store Profile</h2>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn btn-warning">
                    <i class="fas fa-wrench me-2"></i>Modify Profile
                </a>
            </div>
            
            <!-- Profile Card with Hardware Theme -->
            <div class="card shadow-sm border-0" style="background-color: #f9f7f2;">
                <div class="card-header bg-dark text-white">
                    <i class="fas fa-store me-2"></i>Store Information
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Profile Image Column -->
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            <div class="mb-3 position-relative">
                                @if($user->img)
                                    <img src="{{ asset('storage/' . $user->img) }}" 
                                         alt="Store Logo" 
                                         class="rounded img-thumbnail" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default-store.png') }}" 
                                         alt="Store Logo" 
                                         class="rounded img-thumbnail" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                                <div class="store-badge bg-warning text-dark px-2 py-1 rounded position-absolute bottom-0 start-50 translate-middle-x">
                                    <i class="fas fa-certificate me-1"></i>Verified
                                </div>
                            </div>
                            <h5 class="fw-bold mb-0">{{ $user->fname }} {{ $user->lname }}</h5>
                            <p class="text-muted mb-2">{{ Auth::user()->username }}</p>
                            <div class="d-flex justify-content-center">
                                <div class="badge bg-warning text-dark mx-1">
                                    <i class="fas fa-star me-1"></i>4.8
                                </div>
                                <div class="badge bg-secondary mx-1">
                                    <i class="fas fa-hammer me-1"></i>Hardware
                                </div>
                            </div>
                        </div>
                        
                        <!-- Profile Info Column with Hardware Theme -->
                        <div class="col-md-9">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="text-muted small"><i class="fas fa-envelope me-2"></i>Email</span>
                                        <p class="mb-3 fw-medium">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="text-muted small"><i class="fas fa-phone me-2"></i>Contact</span>
                                        <p class="mb-3 fw-medium">{{ $user->contact ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="text-muted small"><i class="fas fa-calendar me-2"></i>Years in Business</span>
                                        <p class="mb-3 fw-medium">{{ $user->age ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-info-item">
                                        <span class="text-muted small"><i class="fas fa-store-alt me-2"></i>Store Type</span>
                                        <p class="mb-3 fw-medium">{{ ucfirst($user->gender) ?? 'Not specified' }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="profile-info-item">
                                        <span class="text-muted small"><i class="fas fa-map-marker-alt me-2"></i>Location</span>
                                        <p class="mb-0 fw-medium">{{ $user->address ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Store Specialties -->
                            <div class="mt-4 pt-3 border-top">
                                <h6 class="fw-bold"><i class="fas fa-toolbox me-2"></i>Store Specialties</h6>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    <span class="badge bg-light text-dark border">Power Tools</span>
                                    <span class="badge bg-light text-dark border">Plumbing</span>
                                    <span class="badge bg-light text-dark border">Electrical</span>
                                    <span class="badge bg-light text-dark border">Home Improvement</span>
                                    <span class="badge bg-light text-dark border">Outdoor Equipment</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-around">
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="fas fa-box me-1"></i>Products
                        </a>
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="fas fa-comment me-1"></i>Reviews
                        </a>
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="fas fa-percent me-1"></i>Promotions
                        </a>
                        <a href="#" class="text-decoration-none text-dark">
                            <i class="fas fa-clock me-1"></i>Hours
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Additional Hardware Store Information -->
            <div class="card shadow-sm border-0 mt-4" style="background-color: #f9f7f2;">
                <div class="card-header bg-dark text-white">
                    <i class="fas fa-info-circle me-2"></i>Store Details
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <h6 class="fw-bold"><i class="fas fa-clock me-2"></i>Business Hours</h6>
                        <div class="row g-2 mt-1">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between">
                                    <span>Monday - Friday:</span>
                                    <span>8:00 AM - 6:00 PM</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between">
                                    <span>Saturday:</span>
                                    <span>9:00 AM - 5:00 PM</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between">
                                    <span>Sunday:</span>
                                    <span>10:00 AM - 3:00 PM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="fw-bold"><i class="fas fa-tags me-2"></i>Services Offered</h6>
                        <ul class="list-unstyled row g-2 mt-1">
                            <li class="col-md-6"><i class="fas fa-check text-success me-2"></i>Tool Rental</li>
                            <li class="col-md-6"><i class="fas fa-check text-success me-2"></i>Key Cutting</li>
                            <li class="col-md-6"><i class="fas fa-check text-success me-2"></i>Paint Mixing</li>
                            <li class="col-md-6"><i class="fas fa-check text-success me-2"></i>Delivery</li>
                            <li class="col-md-6"><i class="fas fa-check text-success me-2"></i>Custom Cuts</li>
                            <li class="col-md-6"><i class="fas fa-check text-success me-2"></i>Installation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-info-item {
        padding: 8px 0;
        background-color: #fff;
        border-radius: 5px;
        padding: 10px 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .profile-info-item span {
        display: block;
        color: #6c757d;
        font-weight: 500;
    }
    .profile-info-item p {
        margin-bottom: 0;
        font-size: 1rem;
    }
    .store-badge {
        font-size: 0.8rem;
        font-weight: 500;
    }
</style>
@endsection