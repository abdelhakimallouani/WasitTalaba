<!DOCTYPE html>
<html>

<head>
    <title>Mes Favoris</title>
</head>

<body>

    <h2> Mes logements favoris</h2>

    <a href="{{ route('logements.index') }}">Retour</a>

    <hr>



    <div style="display:flex; flex-wrap:wrap; gap:20px;">

        @forelse ($favoris as $favori)
            <div style="border:1px solid #ccc; padding:10px; width:250px; position:relative;">

                <a href="{{ route('logements.show', $favori->logement) }}">

                    @if ($favori->logement->images->first())
                        <img src="{{ asset('storage/' . $favori->logement->images->first()->image_path) }}" width="100%"
                            height="150" style="object-fit:cover">
                    @else
                        <img src="https://via.placeholder.com/250x150" width="100%">
                    @endif

                    <h3>{{ $favori->logement->titre }}</h3>
                </a>

                <p>{{ $favori->logement->ville }}</p>
                <p>{{ $favori->logement->prix }} DH</p>

                <form action="{{ route('favoris.store', $favori->logement->id) }}" method="POST">
                    @csrf
                    <button type="submit" style="background:none; border:none; cursor:pointer; font-size:18px;">
                        ❌
                    </button>
                </form>

            </div>
        @empty
            <p>Aucun logement favori</p>
        @endforelse


    </div>

</body>

</html>
