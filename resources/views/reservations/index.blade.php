<!DOCTYPE html>
<html>

<head>
    <title>Reservations</title>
</head>

<body>

    <h2>Liste des demandes de reservation</h2>



    @forelse($reservations as $reservation)
        <div style="border:1px solid #ccc; margin:10px; padding:10px">

            <p><strong>Logement:</strong> {{ $reservation->logement->titre }}</p>
            <p><strong>Student:</strong> {{ $reservation->user->name }}</p>
            <p><strong>Status:</strong> {{ $reservation->statut }}</p>

            <a href="{{ route('reservations.show', $reservation) }}">
                Voir details
            </a>

        </div>
    @empty
        <p>Aucune reservation</p>
    @endforelse

</body>

</html>
