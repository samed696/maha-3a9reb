<h2>Liste des notifications</h2>

@foreach(auth()->user()->notifications as $notification)
    <p>{{ $notification->data['message'] }}</p>
@endforeach
