<x-app-layout>
    <!-- Navbar Spacer -->
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md flex items-center px-8">
    </div>

    <div class="max-w-5xl mx-auto pt-28 pb-12 px-4 sm:px-6">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Détails de la Réservation</h1>
            </div>
            
            <!-- Status Badge -->
            <div class="px-6 py-2  font-black text-xs uppercase tracking-widest shadow-sm border
                @if($reservation->statut == 'pending') bg-orange-50 text-orange-500 border-orange-100
                @elseif($reservation->statut == 'accepted') bg-green-50 text-green-600 border-green-100
                @elseif($reservation->statut == 'rejected') bg-red-50 text-red-600 border-red-100
                @else bg-gray-50 text-gray-500 border-gray-100 @endif">
                Statut: {{ $reservation->statut }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Left Side: Information Cards -->
            <div class="md:col-span-2 space-y-6">
                
                <!-- Student Info Card -->
                <div class="bg-white border border-gray-100  p-8 shadow-sm">
                    <div class="flex items-center gap-4 mb-6 border-b border-gray-50 pb-4">
                        <div class="w-12 h-12 bg-blue-50  flex items-center justify-center text-[#445EF2]">
                            <i class="fas fa-user-graduate text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Informations de l'Étudiant</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Nom complet</p>
                            <p class="text-gray-800 font-bold">{{ $reservation->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Email de contact</p>
                            <p class="text-[#445EF2] font-bold decoration-2 ">{{ $reservation->user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Logement Info Card -->
                <div class="bg-white border border-gray-100  p-8 shadow-sm">
                    <div class="flex items-center gap-4 mb-6 border-b border-gray-50 pb-4">
                        <div class="w-12 h-12 bg-gray-50  flex items-center justify-center text-gray-600">
                            <i class="fas fa-home text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Détails du Logement</h3>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Titre de l'annonce</p>
                            <p class="text-lg text-gray-800 font-black">{{ $reservation->logement->titre }}</p>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600">
                            <i class="fas fa-map-marker-alt text-[#445EF2]"></i>
                            <span class="font-bold text-sm uppercase tracking-wide">{{ $reservation->logement->ville }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Dates & Actions -->
            <div class="space-y-6">
                <!-- Dates Card -->
                <div class="bg-gray-900 text-white  p-8 shadow-xl">
                    <h3 class="text-sm font-black uppercase tracking-[0.2em] mb-6 text-gray-400">Période</h3>
                    
                    <div class="space-y-6 relative">
                        <div class="absolute left-[7px] top-2 bottom-2 w-[2px] bg-gray-800"></div>
                        
                        <div class="relative pl-8">
                            <div class="absolute left-0 top-1 w-4 h-4 bg-[#445EF2] rounded-full border-4 border-gray-900"></div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase">Arrivée</p>
                            <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d M, Y') }}</p>
                        </div>

                        <div class="relative pl-8">
                            <div class="absolute left-0 top-1 w-4 h-4 bg-red-400 rounded-full border-4 border-gray-900"></div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase">Départ</p>
                            <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($reservation->date_fin)->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Card -->
                <div class="bg-white border border-gray-100  p-8 shadow-sm">
                    @if($reservation->statut == 'pending')
                        <p class="text-sm font-medium text-gray-500 mb-6 text-center italic">Cette demande est en attente de votre décision.</p>
                        <div class="flex flex-col gap-3">
                            <form action="{{ route('reservations.accept', $reservation) }}" method="POST" class="w-full">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full bg-green-500 text-white font-black py-4  hover:bg-green-600 transition-all shadow-lg shadow-green-100 active:scale-95 uppercase text-xs tracking-widest">
                                    Accepter la demande
                                </button>
                            </form>

                            <form action="{{ route('reservations.reject', $reservation) }}" method="POST" class="w-full">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full bg-white border-2 border-red-200 text-red-500 font-black py-4  hover:bg-red-50 transition-all active:scale-95 uppercase text-xs tracking-widest">
                                    Refuser
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-check-double text-gray-300"></i>
                            </div>
                            <p class="text-gray-400 font-black uppercase text-[10px] tracking-widest italic">Déjà traitée</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>