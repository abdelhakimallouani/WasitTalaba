<x-app-layout>
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md"></div>
    <div class="relative h-[500px] w-full">
        <div id="map" class="h-full w-full z-0"></div>

        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 w-full max-w-6xl px-4 z-10">
            <form action="{{ route('logements.index') }}" method="GET"
                class="bg-white shadow-2xl p-4 flex flex-wrap lg:flex-nowrap items-center gap-4 border border-slate-100">

                <div class="flex-1 min-w-[200px] relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="ville" placeholder="Ville, quartier..." value="{{ request('ville') }}"
                        class="w-full pl-12 pr-4 py-3 bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="w-full lg:w-48">
                    <select name="type"
                        class="w-full py-3 bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Type de bien</option>
                        <option value="appartement" {{ request('type') == 'appartement' ? 'selected' : '' }}>Appartement
                        </option>
                        <option value="chambre" {{ request('type') == 'chamber' ? 'selected' : '' }}>Chambre</option>
                        <option value="studio" {{ request('type') == 'studio' ? 'selected' : '' }}>Studio</option>
                    </select>
                </div>

                <div class="w-full lg:w-48">
                    <select name="prix_range"
                        class="w-full py-3 bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Budget Max</option>
                        <option value="0-500">0 - 500 DH</option>
                        <option value="500-1000">500 - 1000 DH</option>
                        <option value="1000-2000">1000 - 2000 DH</option>
                        <option value="2000-99999">+2000 DH</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 font-bold transition-all shadow-lg flex items-center gap-2">
                    <i class="fas fa-filter"></i> RECHERCHER
                </button>
            </form>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 mt-24 mb-20">
        <div class="flex flex-col lg:flex-row gap-10">

            <aside class="w-full lg:w-1/4 space-y-8">
                <div class="bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Catégories</h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between text-slate-600 hover:text-indigo-600 cursor-pointer">
                            <span>Appartements</span> <span class="bg-slate-100 px-2 py-0.5 rounded text-xs">{{ $logements->where('type', 'appartement')->count() }}</span>
                        </li>
                        <li class="flex justify-between text-slate-600 hover:text-indigo-600 cursor-pointer">
                            <span>Studios</span> <span class="bg-slate-100 px-2 py-0.5 rounded text-xs">{{ $logements->where('type', 'studio')->count() }}</span>
                        </li>
                        <li class="flex justify-between text-slate-600 hover:text-indigo-600 cursor-pointer">
                            <span>Chambres</span> <span class="bg-slate-100 px-2 py-0.5 rounded text-xs">{{ $logements->where('type', 'chamber')->count() }}</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white p-6 shadow-sm border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Recherche par rayon</h3>
                    <input type="number" name="distance" placeholder="Distance (km)" value="{{ request('distance') }}"
                        class="w-full py-2 bg-slate-50 border-slate-100 mb-4">
                    <button onclick="toggleCircles()"
                        class="text-xs w-full py-2 border border-indigo-600 text-indigo-600 hover:bg-indigo-50 transition">
                        Afficher/Masquer Zones Scolaires
                    </button>
                </div>
            </aside>

            <div class="w-full lg:w-3/4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-slate-900">{{ $logements->count() }} Résultats trouvés</h2>
                    <div class="flex gap-2">
                        <button
                            class="p-2 bg-white border border-slate-200 rounded text-slate-400 hover:text-indigo-600"><i
                                class="fas fa-th-large"></i></button>
                        <button
                            class="p-2 bg-white border border-slate-200 rounded text-slate-400 hover:text-indigo-600"><i
                                class="fas fa-list"></i></button>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($logements as $logement)
                        <div
                            class="bg-white overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 border border-slate-100 group">
                            <div class="relative h-56 overflow-hidden">
                                @if ($logement->images->first())
                                    <a href="{{ route('logements.show', $logement) }}"><img src="{{ asset('storage/' . $logement->images->first()->image_path) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </a>
                                @else
                                    <img src="https://via.placeholder.com/400x300" class="w-full h-full object-cover">
                                @endif

                                <div class="absolute top-3 left-3 flex gap-2">
                                    <span
                                        class="bg-slate-900/80 backdrop-blur-sm text-white text-[10px] px-2 py-1 rounded shadow-lg uppercase font-bold">{{ $logement->type }}</span>
                                </div>

                                <form action="{{ route('favoris.store', $logement) }}" method="POST"
                                    class="absolute top-3 right-3">
                                    @csrf
                                    <button type="submit"
                                        class="w-8 h-8 bg-white/90 hover:bg-white text-slate-900 rounded-full flex items-center justify-center transition-all shadow shadow-black/20">
                                        <i
                                            class="{{ $logement->is_favorite ? 'fas fa-heart text-rose-500' : 'far fa-heart' }} text-sm"></i>
                                    </button>
                                </form>
                                <div
                                    class="absolute bottom-4 left-4 bg-indigo-600 text-white text-[10px] font-bold px-4 py-1.5 shadow-lg">
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center justify-center">
                                            <i class="fas fa-user text-[10px] text-indigo-100"></i>
                                        </div>
                                        <p>For <span
                                                class="text-xs font-medium">{{ strtolower($logement->user->name) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <h3
                                        class="font-bold text-slate-900 truncate pr-2 group-hover:text-indigo-600 transition-colors">
                                        {{ $logement->titre }}
                                    </h3>
                                    <p class="text-indigo-700 font-extrabold whitespace-nowrap">
                                        {{ number_format($logement->prix, 0, ',', ' ') }} DH<span
                                            class="text-[10px] text-slate-400 font-normal">/mo</span>
                                    </p>
                                </div>
                                <p class="text-slate-400 text-xs flex items-center gap-1 mb-4">
                                    <i class="fas fa-map-marker-alt"></i> {{ $logement->ville }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full text-center py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                            <p class="text-slate-400">Aucun logement trouvé.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <script>
        window.logements = @json($logements);
        window.ecoles = @json($ecoles);
    </script>

        @include('layouts.footer')

</x-app-layout>
