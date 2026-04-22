<x-app-layout>
    <!-- Navbar / Header Fixe -->
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md flex items-center px-8">
    </div>

    <div class="max-w-5xl mx-auto pt-28 pb-12 px-4 sm:px-6">
        
        <!-- Titre de la page -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight ">Notifications</h1>
                <p class="text-gray-500 mt-1">Restez informé de l'activité de vos réservations.</p>
            </div>
            <!-- Badge Compteur -->
            <div class="bg-[#445ef222] text-[#445ef2] px-3 py-2 rounded-full font-black text-sm shadow-lg shadow-blue-100">
                {{ auth()->user()->notifications->count() }}
            </div>
        </div>

        <div class="space-y-4">
            @forelse(auth()->user()->notifications as $notification)
                <div class="group relative bg-white border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all flex items-start gap-5">
                    
                    <!-- Icône de Notification -->
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex-shrink-0 flex items-center justify-center text-[#445EF2] group-hover:scale-110 transition-transform">
                        @if(str_contains($notification->data['message'], 'accept'))
                            <i class="fas fa-check-circle text-green-500"></i>
                        @elseif(str_contains($notification->data['message'], 'refus') || str_contains($notification->data['message'], 'reject'))
                            <i class="fas fa-times-circle text-red-500"></i>
                        @else
                            <i class="fas fa-bell"></i>
                        @endif
                    </div>

                    <!-- Contenu -->
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-1 mb-1">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Notification Système</span>
                            <span class="text-[11px] text-gray-400 font-medium">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-gray-800 font-bold leading-relaxed">
                            {{ $notification->data['message'] }}
                        </p>
                    </div>

                </div>
            @empty
                <!-- État Vide -->
                <div class="bg-gray-50 rounded-[2.5rem] border-2 border-dashed border-gray-200 py-20 text-center">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <i class="far fa-bell-slash text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-400 uppercase tracking-tighter italic">Tout est à jour !</h3>
                    <p class="text-gray-500 mt-2">Vous n'avez aucune notification pour le moment.</p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>