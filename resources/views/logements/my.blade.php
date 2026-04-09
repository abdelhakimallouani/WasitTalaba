<!DOCTYPE html>
<html>

<head>
    <title>Create Logement</title>
</head>

<body>

    <h2>Liste des logements</h2>


    @foreach ($logements as $logement)
        <div style="border:1px solid #ccc; padding:10px; margin:10px; width:250px">

            @if ($logement->images->first())
                <img src="{{ asset('storage/' . $logement->images->first()->image_path) }}" width="100%" height="150"
                    style="object-fit:cover">
            @else
                <img src="https://via.placeholder.com/250x150" width="100%">
            @endif

            {{-- infos --}}
            <h3>{{ $logement->titre }}</h3>
            <p>{{ $logement->ville }}</p>
            <p>{{ $logement->prix }} DH</p>

        </div>
    @endforeach




</body>

</html>
