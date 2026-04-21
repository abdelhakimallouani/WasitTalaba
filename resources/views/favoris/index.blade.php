<x-app-layout>
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md"></div>

    <div class="max-w-7xl mx-auto pt-28 pb-12 px-4">
        
        <div class="flex justify-between items-center mb-8 border-b pb-6">
            <div>
                <h1 class="text-3xl font-black text-gray-800 tracking-tight ">Mes logements favoris</h1>
                <p class="text-gray-500 font-medium">Vous avez {{ $favoris->count() }} logement(s) enregistré(s)</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($favoris as $favori)
                <div class="group relative bg-white border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                    
                    <div class="absolute top-4 right-4 z-10">
                        <form action="{{ route('favoris.store', $favori->logement->id) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="w-10 h-10 bg-white/90 backdrop-blur-sm text-red-500 rounded-full flex items-center justify-center shadow-lg hover:bg-red-500 hover:text-white transition-all active:scale-90"
                                    title="Retirer des favoris">
                                <i class="fas fa-heart text-lg"></i>
                            </button>
                        </form>
                    </div>

                    <a href="{{ route('logements.show', $favori->logement) }}" class="block overflow-hidden">
                        <div class="h-64 overflow-hidden relative">
                            @if ($favori->logement->images->first())
                                <img src="{{ asset('storage/' . $favori->logement->images->first()->image_path) }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <img src="https://via.placeholder.com/400x300?text=No+Image" 
                                     class="w-full h-full object-cover">
                            @endif
                            <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-lg shadow-sm">
                                <span class="font-black text-gray-900 text-sm">{{ $favori->logement->prix }} DH</span>
                                <span class="text-[10px] text-gray-500 font-bold uppercase">/ mois</span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-gray-800 group-hover:text-[#445EF2] transition-colors leading-tight">
                                    {{ $favori->logement->titre ?? 'Logement sans titre' }}
                                </h3>
                            </div>
                            
                            <p class="text-gray-500 text-sm flex items-center gap-1 font-medium mb-4 italic">
                                <i class="fas fa-map-marker-alt text-red-400"></i> {{ $favori->logement->ville }}
                            </p>

                            <div class="flex items-center justify-between border-t pt-4">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $favori->logement->type }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-gray-50 border-2 border-dashed border-gray-200">
                    <div class="mb-4">
                        <i class="far fa-heart text-6xl text-gray-200"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-400">Aucun logement favori pour le moment</h2>
                    <p class="text-gray-500 mb-8">Parcourez les annonces et cliquez sur le coeur pour les ajouter ici.</p>
                    <a href="{{ route('logements.index') }}" 
                       class="bg-[#445EF2] text-white px-8 py-3 font-bold hover:shadow-lg hover:shadow-indigo-200 transition-all">
                        Découvrir les logements
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>