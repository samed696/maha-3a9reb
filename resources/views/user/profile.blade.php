@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>My Profile</h3>
    </div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <!-- Add more user info as needed -->
    </div>
</div>
@endsection
