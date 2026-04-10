<!DOCTYPE html>
<html>

<head>
    <title>Create Logement</title>
</head>

<body>

    <a href="{{ route('dashboard') }}">Back to Dashboard</a>

    <h2>Liste des logements</h2>

    <form action="{{ route('logements.index') }}" method="GET">
        <div>
            <label for="ville">Ville:</label>
            <input type="text" name="ville" id="ville" value="{{ request('ville') }}">
        </div>
        <div>
            <select name="type" id="">
                <option value="">Type</option>
                <option value="appartement" {{ request('type') == 'appartement' ? 'selected' : '' }}>Appartement
                </option>
                <option value="chambre" {{ request('type') == 'chambre' ? 'selected' : '' }}>Chambre</option>
                <option value="studio" {{ request('type') == 'studio' ? 'selected' : '' }}>Studio</option>
            </select>
        </div>
        <select name="prix_range">
            <option value="">Prix</option>

            <option value="0-100" {{ request('prix_range') == '0-100' }}>
                0 - 100 DH
            </option>

            <option value="100-500" {{ request('prix_range') == '100-500' }}>
                100 - 500 DH
            </option>

            <option value="500-1000" {{ request('prix_range') == '500-1000' }}>
                500 - 1000 DH
            </option>

            <option value="1000-2000" {{ request('prix_range') == '1000-2000' }}>
                1000 - 2000 DH
            </option>

            <option value="2000-99999" {{ request('prix_range') == '2000-99999' }}>
                +2000 DH
            </option>
        </select>
        <div>
            <input type="hidden" name="latitude" id="lat">
            <input type="hidden" name="longitude" id="lng">
            <input type="number" name="distance" placeholder="Distance (km) " value="{{ request('distance') }}">
        </div>

        <button type="submit">Filtrer</button>
    </form>

    <div style="display:flex; flex-wrap:wrap; gap:20px;">
        @forelse ($logements as $logement)
            <div style="border:1px solid #ccc; padding:10px; margin:10px; width:250px">
                <a href="{{ route('logements.show', $logement) }}">

                    @if ($logement->images->first())
                        <img src="{{ asset('storage/' . $logement->images->first()->image_path) }}" width="100%"
                            height="150" style="object-fit:cover">
                    @else
                        <img src="https://via.placeholder.com/250x150" width="100%">
                    @endif

                    <h3>{{ $logement->titre }}</h3>
                </a>
                <p>{{ $logement->ville }}</p>
                <p>{{ $logement->prix }} DH</p>
                <a href="{{ route('logements.edit', $logement) }}">Edit</a>
                <form action="{{ route('logements.destroy', $logement) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>

            </div>
        @empty
            <p>Aucun logement </p>
        @endforelse
    </div>
</body>

{{-- 
<script>
    navigator.geolocation.getCurrentPosition(function(position) {
        document.getElementById('lat').value = position.coords.latitude;
        document.getElementById('lng').value = position.coords.longitude;
    });
</script> --}}

</html>
