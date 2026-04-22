<x-app-layout>
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md flex items-center px-8 text-white font-bold">
    </div>

    <div class="max-w-5xl mx-auto pt-28 pb-12 px-4 sm:px-6">

        <div class="mb-8">
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Demandes de réservation</h2>
            <p class="text-gray-500">Suivez l'état des demandes envoyées par les étudiants.</p>
        </div>

        <div class="grid gap-4">
            @forelse($reservations as $reservation)
                <div class="relative group">
                    
                    <a href="{{ route('reservations.show', $reservation) }}" 
                       class="flex flex-col md:flex-row items-center justify-between gap-6 bg-white border border-gray-100 p-6 shadow-sm hover:shadow-md hover:border-[#445EF2]/30 transition-all">
                        
                        <div class="flex items-center gap-4 flex-1">
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-[#445EF2]">
                                <i class="fas fa-calendar-check text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg leading-tight group-hover:text-[#445EF2] transition-colors">
                                    {{ $reservation->logement->titre }}
                                </h3>
                                <p class="text-sm text-gray-500 font-medium">Par: <span class="text-gray-700">{{ $reservation->user->name }}</span></p>
                            </div>
                        </div>

                        <div class="px-6 py-2 font-bold text-xs uppercase tracking-widest
                            @if ($reservation->statut == 'pending') bg-orange-50 text-orange-500 border border-orange-100
                            @elseif($reservation->statut == 'accepted') bg-green-50 text-green-600 border border-green-100
                            @elseif($reservation->statut == 'rejected') bg-red-50 text-red-600 border border-red-100
                            @else bg-gray-50 text-gray-500 @endif">
                            {{ $reservation->statut }}
                        </div>

                        <div class="absolute right-6 top-1/2 -translate-y-1/2 z-50 md:relative md:top-0 md:translate-y-0">
                            <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Supprimer cette demande ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-10 h-10 flex items-center justify-center text-red-400  hover:text-red-500 transition shadow-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </a>

                </div>
            @empty
                <div class="bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200 py-16 text-center">
                    <i class="far fa-folder-open text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-400 font-bold uppercase tracking-widest">Aucune réservation pour le moment</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>