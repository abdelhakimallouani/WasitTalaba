<!DOCTYPE html>
<html>
<head>
    <title>Detail reservation</title>
</head>
<body>

<h2>Detail de la reservation</h2>

<p><strong>Student:</strong> {{ $reservation->user->name }}</p>
<p><strong>Email:</strong> {{ $reservation->user->email }}</p>

<p><strong>Logement:</strong> {{ $reservation->logement->titre }}</p>
<p><strong>Ville:</strong> {{ $reservation->logement->ville }}</p>

<p><strong>Date debut:</strong> {{ $reservation->date_debut }}</p>
<p><strong>Date fin:</strong> {{ $reservation->date_fin }}</p>

<p><strong>Status:</strong> {{ $reservation->statut }}</p>

<hr>

@if($reservation->statut == 'pending')

    <form action="{{ route('reservations.accept', $reservation) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button style="color : green" type="submit">Accept</button>
    </form>

    <form action="{{ route('reservations.reject', $reservation) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button style="color : red" type="submit">Reject</button>
    </form>

@else
    <p>Dejà traite </p>
@endif

<br><br>
<a href="{{ route('reservations.index') }}"> Back</a>

</body>
</html>