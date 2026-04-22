<x-app-layout>
    <!-- Header / Navbar Space Fix -->
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md flex items-center px-8">
    </div>

    <div class="max-w-7xl mx-auto pt-28 pb-12 px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Mes Logements</h1>
                <p class="text-gray-500 mt-1">Gérez vos annonces et visualisez vos propriétés en un clin d'œil.</p>
            </div>
            <a href="{{ route('logements.create') }}"
                class="inline-flex items-center justify-center px-6 py-3 bg-[#445EF2] text-white font-bold rounded shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                <i class="fas fa-plus mr-2"></i> Ajouter un Logement
            </a>
        </div>

        <!-- Grid Logements -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($logements as $logement)
                <div
                    class="group bg-white border border-gray-100 overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col h-full">

                    <!-- Image Container -->
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <a href="{{ route('logements.show', $logement) }}">
                            @if ($logement->images->first())
                                <img src="{{ asset('storage/' . $logement->images->first()->image_path) }}"
                                    alt="{{ $logement->titre }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <img src="https://via.placeholder.com/400x300?text=Aucune+Image"
                                    class="w-full h-full object-cover">
                            @endif
                        </a>
                        <!-- Badge Ville -->
                        <div
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded shadow-sm">
                            <span
                                class="text-[10px] font-black uppercase tracking-widest text-gray-700">{{ $logement->ville }}</span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex items-center justify-between">
                        <div class="">
                            <h3
                                class="text-lg font-bold text-gray-500 truncate group-hover:text-[#445EF2] transition-colors">
                                {{ $logement->titre }}
                            </h3>
                            <div class="flex items-center mt-2 text-[#445EF2]">
                                <span
                                    class="text-xl font-black">{{ number_format($logement->prix, 0, ',', ' ') }}</span>
                                <span class="text-sm font-bold ml-1 uppercase">DH</span>
                            </div>
                        </div>

                        <!-- Actions Buttons -->
                        <div class="flex flex-col items-center justify-center gap-4">
                            <!-- Edit Button -->
                            <a href="{{ route('logements.edit', $logement) }}"
                                class="flex items-center justify-center text-gray-500 hover:text-[#445EF2] transition-all shadow-sm">
                                <i class="far fa-edit"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('logements.destroy', $logement) }}" method="POST"
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center justify-center text-red-400 hover:text-red-700 transition-all shadow-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full py-20 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-home text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-400 uppercase tracking-tighter italic">Aucun logement trouvé
                    </h3>
                    <p class="text-gray-500 mt-2">Commencez par ajouter votre première propriété.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
