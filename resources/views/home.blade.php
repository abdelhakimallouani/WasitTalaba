<x-app-layout>
    <div class="relative">
        @include('layouts.navigation')
        @include('layouts.header')
    </div>

    <main >

        <section class="max-w-7xl mx-auto px-4 -mt-16 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 shadow-xl border border-slate-100 flex flex-col items-center cursor-pointer">
                    <div
                        class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <span class="font-bold text-slate-700">Stages</span>
                </div>
                <div class="bg-white p-6 shadow-xl border border-slate-100 flex flex-col items-center cursor-pointer">
                    <div
                        class="w-12 h-12 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="font-bold text-slate-700">Logements</span>
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
                                <img src="{{ asset('storage/' . $logement->images->first()->image_path) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
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

                                <a href="{{ route('logements.show', $logement) }}"
                                    class="w-10 h-10 border border-slate-100 rounded-full flex items-center justify-center text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all cursor-pointer">
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
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

        <div class="h-[500px] w-[70%] mx-auto mb-20">

            <div id="map" class="h-full w-full"></div>
        </div>

    <script>
        window.logements = @json($logements);
        window.ecoles = @json($ecoles);
    </script>
    </main>


    @include('layouts.footer')
</x-app-layout>
