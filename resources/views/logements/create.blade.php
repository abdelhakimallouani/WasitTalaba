<!DOCTYPE html>
<html>
<head>
    <title>Create Logement</title>
</head>
<body>

<h2>Ajouter un logement</h2>

{{-- Success message --}}
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('logements.store') }}" method="POST">
    @csrf

    <div>
        <label>Titre:</label>
        <input type="text" name="titre" value="{{ old('titre') }}">
    </div>

    <div>
        <label>Description:</label>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <div>
        <label>Prix:</label>
        <input type="number" name="prix" value="{{ old('prix') }}">
    </div>

    <div>
        <label>Type:</label>
        <input type="text" name="type" value="{{ old('type') }}">
    </div>

    <div>
        <label>Ville:</label>
        <input type="text" name="ville" value="{{ old('ville') }}">
    </div>

    <div>
        <label>Adresse:</label>
        <input type="text" name="adresse" value="{{ old('adresse') }}">
    </div>

    <div>
        <label>Latitude:</label>
        <input type="text" name="latitude" value="{{ old('latitude') }}">
    </div>

    <div>
        <label>Longitude:</label>
        <input type="text" name="longitude" value="{{ old('longitude') }}">
    </div>

    <button type="submit">Ajouter</button>

</form>

</body>
</html>