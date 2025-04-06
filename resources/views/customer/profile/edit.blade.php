@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $account->username) }}" required>
        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="fname" class="form-control" value="{{ old('fname', $user->fname) }}" required>
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="lname" class="form-control" value="{{ old('lname', $user->lname) }}" required>
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $user->age) }}" required>
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
                <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="contact" class="form-control" value="{{ old('contact', $user->contact) }}" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" rows="4" required>{{ old('address', $user->address) }}</textarea>
        </div>


        <div class="mb-3">
            <label>Profile Image</label><br>
            <img src="{{ asset('storage/user_img/' . $user->img) }}" alt="Current Image" width="80" class="mb-2">
            <input type="file" name="img" class="form-control">
        </div>

        <hr>
        <h4>Change Password (optional)</h4>
        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save Changes</button>
        <a href="{{ route('profile.view') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
