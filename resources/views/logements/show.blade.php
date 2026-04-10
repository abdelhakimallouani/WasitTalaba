<!DOCTYPE html>
<html>
<head>
    <title>Details Logement</title>
</head>
<body>

<a href="{{ route('logements.index') }}"> Back</a>

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

@if(auth()->user()->role == 'student')

<form action="{{ route('reservations.store', $logement) }}" method="POST">
    @csrf

    <input type="date" name="date_debut" required>
    <input type="date" name="date_fin" required>

    <button type="submit">Réserver</button>
</form>

@endif

</body>
</html>