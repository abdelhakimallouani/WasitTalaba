<!DOCTYPE html>
<html>

<head>
    <title>Create Logement</title>
</head>

<body>
    
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>

    <h2>Liste des logements</h2>


    @foreach ($logements as $logement)
        <a href="{{ route('logements.show', $logement) }}">
            <div style="border:1px solid #ccc; padding:10px; margin:10px; width:250px">

                @if ($logement->images->first())
                    <img src="{{ asset('storage/' . $logement->images->first()->image_path) }}" width="100%"
                        height="150" style="object-fit:cover">
                @else
                    <img src="https://via.placeholder.com/250x150" width="100%">
                @endif

                {{-- infos --}}
                <h3>{{ $logement->titre }}</h3>
                <p>{{ $logement->ville }}</p>
                <p>{{ $logement->prix }} DH</p>
                <a href="{{ route('logements.edit', $logement) }}">Edit</a>
                <form action="{{ route('logements.destroy', $logement) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>

            </div>
        </a>
    @endforeach




</body>

</html>
