
<a href="{{ route('dashboard') }}">Back</a>

<h3>Notifications</h3>

@forelse(auth()->user()->notifications as $notification)
    <div style="border:1px solid gray; margin:5px; padding:5px">
        <p>{{ $notification->data['message'] }}</p>
    </div>
@empty
    <p>Aucune notification</p>
@endforelse