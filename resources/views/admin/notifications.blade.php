@extends('layouts.app')

@section('title', 'Notifications Admin')

@section('content')
<div class="container mt-4">
    <h2>Liste des notifications</h2>

    @if(auth()->user()->notifications->isEmpty())
        <p>Aucune notification pour le moment.</p>
    @else
        <ul class="list-group">
            @foreach(auth()->user()->notifications as $notification)
                <li class="list-group-item">
                    {{ $notification->data['message'] ?? 'Notification sans message' }}
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
