<h2>Conversations</h2>
<a href="{{ route('dashboard') }}">Back to Dashboard</a>

@forelse($user as $u)
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <a href="{{ route('messages.show', $u) }}">
            {{ $u->name }}
        </a>
    </div>
@empty
    <p>No conversations</p>
@endforelse