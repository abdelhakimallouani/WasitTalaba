<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->role =='owner')
        <p>Welcome, owner!</p><br>
        <button><a href="{{ route('logements.create') }}">Create Logement</a></button><br><br>
        <button><a href="{{ route('logements.my') }}">View Logements</a></button><br><br>
        <button><a href="{{ route('reservations.index') }}">View Reservations</a></button>
    @else
        <p>Welcome, student!</p>
        <button><a href="{{ route('logements.index') }}">View Tous les Logements</a></button>
    @endif

</x-app-layout>
