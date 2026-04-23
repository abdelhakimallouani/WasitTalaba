<x-app-layout>
    <div class="relative">
        @include('layouts.navigation')
        @include('layouts.header')
    </div>

    <main>

        <section class="max-w-7xl mx-auto px-4 -mt-16 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 shadow-xl border border-slate-100 flex flex-col items-center cursor-pointer">
                    <div
                        class="w-12 h-12 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="font-bold text-slate-700">Logements</span>
                </div>
                <div class="bg-white p-6 shadow-xl border border-slate-100 flex flex-col items-center cursor-pointer">
                    <div
                        class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <span class="font-bold text-slate-700">Locations</span>
                </div>
                <div class="bg-white p-6 shadow-xl border border-slate-100 flex flex-col items-center cursor-pointer">
                    <div
                        class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <span class="font-bold text-slate-700">Services</span>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 py-20">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">Opportunités récentes</h2>
                    <p class="text-slate-500">Découvrez les dernières offres publiées pour vous.</p>
                </div>
                <a href="{{ route('logements.index') }}" class="text-indigo-600 font-semibold hover:underline">Voir
                    tout</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($logements as $logement)
                    <div
                        class="bg-white overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
                        <div class="relative h-64 overflow-hidden">
                            @if ($logement->images->first())
                                <a href="{{ route('logements.show', $logement) }}">
                                    <img src="{{ asset('storage/' . $logement->images->first()->image_path) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </a>
                            @else
                                <img src="https://via.placeholder.com/400x300" class="w-full h-full object-cover">
                            @endif

                            <div
                                class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-slate-900 text-[10px] font-bold px-3 py-1 rounded-lg shadow-sm uppercase">
                                {{ $logement->type }}
                            </div>

                            <form action="{{ route('favoris.store', $logement) }}" method="POST"
                                class="absolute top-4 right-4">
                                @csrf
                                <button type="submit"
                                    class="w-10 h-10 bg-slate-900/30 backdrop-blur-md hover:bg-white text-white hover:text-rose-500 rounded-full flex items-center justify-center transition-all shadow-lg">
                                    <i
                                        class="{{ $logement->is_favorite ? 'fas fa-heart text-rose-500' : 'far fa-heart' }}  text-sm"></i>
                                </button>
                            </form>

                            <div
                                class="absolute bottom-4 left-4 bg-indigo-600 text-white text-[10px] font-bold px-4 py-1.5 rounded-lg shadow-lg">
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

                        <div class="p-6">
                            <h3
                                class="text-xl font-bold text-slate-900 mb-1 group-hover:text-indigo-600 transition-colors">
                                {{ $logement->titre }}
                            </h3>

                            <div class="flex items-center text-slate-400 text-xs">
                                <i class="fas fa-map-marker-alt mr-2"></i> {{ $logement->ville }}
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                <div>
                                    <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Price</p>
                                    <p class="text-xl font-extrabold text-indigo-700">
                                        {{ number_format($logement->prix, 0, ',', ' ') }} DH
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-3 text-center py-20 bg-white rounded-3xl border-2 border-dashed border-slate-100">
                        <i class="fas fa-home text-4xl text-slate-200 mb-4"></i>
                        <p class="text-slate-400 italic">Aucune opportunité disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 mb-10 text-start">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">
                    Localisation des opportunités
                </h2>
                <p class="text-slate-500 text-start">
                    Visualisez facilement les logements et les services disponibles à proximité de votre établissement
                    scolaire pour optimiser vos déplacements.
                </p>
            </div>

            <div class="relative">
                <div id="map" class="h-[500px] w-[75%] mx-auto z-0 rounded-lg shadow-lg"></div>
            </div>
        </div>
        </div>

        <section class="max-w-7xl mx-auto px-4 py-16 mb-10 ">
            <div class="flex flex-col lg:flex-row items-center gap-16">

                <div class="lg:w-1/2 relative">
                    <div class="relative z-10">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1000"
                            alt="Communauté Étudiante" class="w-full h-[480px] object-cover">
                    </div>

                    <div
                        class="absolute -bottom-8 -right-6 bg-white p-7 max-w-[320px]  shadow-2xl border border-slate-50 z-20">
                        <div class="flex text-orange-400 mb-3 gap-1">
                            <i class="fas fa-star text-xs"></i><i class="fas fa-star text-xs"></i><i
                                class="fas fa-star text-xs"></i><i class="fas fa-star text-xs"></i><i
                                class="fas fa-star text-xs"></i>
                        </div>
                        <p class="text-slate-700 font-bold italic mb-5 leading-relaxed">
                            "L'outil indispensable pour tout étudiant arrivant dans une nouvelle ville. Sécurisé et
                            efficace !"
                        </p>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 bg-indigo-600 rounded-full flex items-center justify-center font-bold text-white shadow-lg">
                                AM
                            </div>
                            <div>
                                <p class="font-extrabold text-slate-900 text-sm">Mohammed Amine Nafiai</p>
                                <p class="text-[11px] text-indigo-500 uppercase font-bold tracking-widest mt-0.5">
                                    Étudiant à YouCode</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <h2 class="text-1xl md:text-4xl font-semibold text-slate-900 mb-8 leading-[1.1]">
                        Pourquoi choisir <span class="text-indigo-600">WasiT Talaba</span> ?
                    </h2>

                    <div class="space-y-10">
                        <div class="flex items-start gap-6 group">
                            <div
                                class="shrink-0 w-12 h-12 bg-white shadow-md text-indigo-600 rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                01
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2">Annonces Vérifiées</h3>
                                <p class="text-slate-500 leading-relaxed">
                                    Nous luttons contre les arnaques au logement en vérifiant manuellement chaque
                                    annonce publiée.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-6 group">
                            <div
                                class="shrink-0 w-12 h-12 bg-white shadow-md text-indigo-600 rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                02
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2">Proximité des Écoles</h3>
                                <p class="text-slate-500 leading-relaxed">
                                    Filtrez vos recherches selon la distance réelle entre votre logement et votre campus
                                    universitaire.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-6 group">
                            <div
                                class="shrink-0 w-12 h-12 bg-white shadow-md text-indigo-600 rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                03
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2">Processus 100% Digital</h3>
                                <p class="text-slate-500 leading-relaxed">
                                    Contactez les bailleurs ou les entreprises directement via la plateforme sans
                                    intermédiaire.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <script>
            window.logements = @json($logements);
            window.ecoles = @json($ecoles);
        </script>
    </main>


    @include('layouts.footer')
</x-app-layout>
