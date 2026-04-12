<!DOCTYPE html>
<html>

<head>
    <title>Details Logement</title>
</head>

<body>

    <a href="{{ route('logements.index') }}"> Back</a>
    @if (auth()->user()->role == 'owner')
        <a href="{{ route('logements.my', $logement) }}"> Back</a>
    @endif

    <h2>{{ $logement->titre }}</h2>

    <div>
        @forelse($logement->images as $image)
            <img src="{{ asset('storage/' . $image->image_path) }}" width="250" style="margin:5px;">
        @empty
            <img src="https://via.placeholder.com/250x150">
        @endforelse
    </div>

    <p><strong>Ville:</strong> {{ $logement->ville }}</p>
    <p><strong>Adresse:</strong> {{ $logement->adresse }}</p>
    <p><strong>Type:</strong> {{ $logement->type }}</p>
    <p><strong>Prix:</strong> {{ $logement->prix }} DH</p>

    <p><strong>Description:</strong></p>
    <p>{{ $logement->description }}</p>

    <p><strong>Proprietaire:</strong> {{ $logement->user->name }}</p>

    @if (auth()->user()->role == 'student')

        <form action="{{ route('reservations.store', $logement) }}" method="POST">
            @csrf

            <input type="date" name="date_debut" required>
            <input type="date" name="date_fin" required>

            <button type="submit">Réserver</button>
        </form>

        <h3>Ajouter un avis</h3>

        <form action="{{ route('avis.store', $logement->id) }}" method="POST">
            @csrf

            <div>
                <label>Note:</label>
                <select name="note">
                    <option value="1">1 ⭐</option>
                    <option value="2">2 ⭐⭐</option>
                    <option value="3">3 ⭐⭐⭐</option>
                    <option value="4">4 ⭐⭐⭐⭐</option>
                    <option value="5">5 ⭐⭐⭐⭐⭐</option>
                </select>
            </div>

            <div>
                <label>Commentaire:</label>
                <textarea name="commentaire"></textarea>
            </div>

            <button type="submit">Envoyer</button>
        </form>



        <h3>Avis des utilisateurs</h3>

        @forelse($logement->avis as $avis)
            <div style="border:1px solid #ccc; margin:10px; padding:10px;">
                <p><strong>{{ $avis->user->name }}</strong></p>
                <p>Note: {{ $avis->note }} ⭐</p>
                <p>{{ $avis->commentaire }}</p>
            </div>
        @empty
            <p>Aucun avis pour ce logement</p>
        @endforelse

    @endif
    @if (auth()->user()->role == 'owner' && auth()->id() == $logement->user_id)
        <h3>Avis des utilisateurs</h3>

        @forelse($logement->avis as $avis)
            <div style="border:1px solid #ccc; margin:10px; padding:10px;">
                <p><strong>{{ $avis->user->name }}</strong></p>
                <p>Note: {{ $avis->note }} ⭐</p>
                <p>{{ $avis->commentaire }}</p>
            </div>
        @empty
            <p>Aucun avis pour ce logement</p>
        @endforelse
    @endif


</body>

</html>
