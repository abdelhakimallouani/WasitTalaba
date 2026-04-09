<!DOCTYPE html>
<html>
<head>
    <title>Update Logement</title>
</head>
<body>

<h2>Modifier le logement</h2>

{{-- Success message --}}
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('logements.update', $logement->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>Titre:</label>
        <input type="text" name="titre" value="{{ old('titre', $logement->titre) }}">
    </div>

    <div>
        <label>Description:</label>
        <textarea name="description">{{ old('description', $logement->description) }}</textarea>
    </div>

    <div>
        <label>Prix:</label>
        <input type="number" name="prix" value="{{ old('prix', $logement->prix) }}">
    </div>

    <div>
        <label>Type:</label>
        <input type="text" name="type" value="{{ old('type', $logement->type) }}">
    </div>

    <div>
        <label>Ville:</label>
        <input type="text" name="ville" value="{{ old('ville', $logement->ville) }}">
    </div>

    <div>
        <label>Adresse:</label>
        <input type="text" name="adresse" value="{{ old('adresse', $logement->adresse) }}">
    </div>

    <div>
        <label>Latitude:</label>
        <input type="text" name="latitude" value="{{ old('latitude', $logement->latitude) }}">
    </div>

    <div>
        <label>Longitude:</label>
        <input type="text" name="longitude" value="{{ old('longitude', $logement->longitude) }}">
    </div>

    <div>
        <label>Ajouter nouvelles images:</label>
        <input type="file" name="images[]" multiple>
    </div>

    <button type="submit">Mettre à jour</button>

</form>

</body>
</html>