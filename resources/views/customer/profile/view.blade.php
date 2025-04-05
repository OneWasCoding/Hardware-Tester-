@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profile Information</h2>

    <div class="card p-3">
        <img src="{{ asset('storage/user_img/' . $user->img) }}" alt="Profile Picture" width="100">
        <p><strong>Full Name:</strong> {{ $user->fname }} {{ $user->lname }}</p>
        <p><strong>Age:</strong> {{ $user->age }}</p>
        <p><strong>Gender:</strong> {{ ucfirst($user->gender) }}</p>
        <p><strong>Contact:</strong> {{ $user->contact }}</p>
        <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
    </div>
</div>
@endsection