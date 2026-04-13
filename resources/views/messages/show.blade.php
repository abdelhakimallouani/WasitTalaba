<a href="{{ route('dashboard') }}">back</a>
<h2>Chat avec {{ $user->name }}</h2>

<div style="border:1px solid #ccc; padding:10px; height:300px; overflow:auto;">
    @foreach($messages as $msg)
        <div style="margin:5px;">
            @if($msg->sender_id == auth()->id())
                <p style="text-align:right; color:blue;">
                    {{ $msg->contenu }}
                </p>
            @else
                <p style="text-align:left; color:green;">
                    {{ $msg->contenu }}
                </p>
            @endif
        </div>
    @endforeach
</div>

<form action="{{ route('messages.store', $user) }}" method="POST">
    @csrf
    <input type="text" name="contenu" placeholder="Write message..." required>
    <button type="submit">Send</button>
</form>