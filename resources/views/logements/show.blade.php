<x-app-layout>
    <div class="bg-[#F8F9FA] min-h-screen pb-20 font-sans antialiased text-[#010E26]">
        <div class="bg-[#445EF2] border-b h-20 w-full -mt-px "></div>

        <main class="max-w-6xl mx-auto px-6 pt-10">

            <div class="grid grid-cols-12 grid-rows-2 gap-3 h-[380px] md:h-[500px] mb-10 group">
                <div class="col-span-12 md:col-span-8 row-span-2 overflow-hidden relative shadow-sm rounded-2xl">
                    <img src="{{ $logement->images->first() ? asset('storage/' . $logement->images->first()->image_path) : 'https://via.placeholder.com/1200x800' }}"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-[1.02]">
                </div>
                <div class="hidden md:block col-span-4 row-span-1 overflow-hidden relative shadow-sm rounded-2xl">
                    <img src="{{ isset($logement->images[1]) ? asset('storage/' . $logement->images[1]->image_path) : 'https://via.placeholder.com/600x400' }}"
                        class="w-full h-full object-cover">
                </div>
                <div class="hidden md:block col-span-4 row-span-1 overflow-hidden relative shadow-sm rounded-2xl">
                    <img src="{{ isset($logement->images[2]) ? asset('storage/' . $logement->images[2]->image_path) : 'https://via.placeholder.com/600x400' }}"
                        class="w-full h-full object-cover">
                    @if ($logement->images->count() > 3)
                        <button
                            class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-5 py-2.5 rounded-xl font-bold text-xs shadow-sm flex items-center gap-2 hover:bg-[#010E26] hover:text-white transition-all">
                            <i class="fas fa-th-large"></i> {{ $logement->images->count() }} PHOTOS
                        </button>
                    @endif
                </div>
            </div>

            <div class="mb-10">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-4">{{ $logement->titre }}</h1>
                        <div class="flex flex-wrap items-center gap-4 text-sm font-bold text-[#666666]">
                            <span
                                class="flex items-center gap-1.5 bg-[#445EF2]/5 text-[#445EF2] px-3 py-1.5 rounded-lg">
                                <i class="fas fa-map-marker-alt"></i> {{ $logement->ville }}
                            </span>
                            <span class="text-[#888888]">{{ $logement->adresse }}</span>
                            <span class="text-yellow-500 flex items-center gap-1">
                                <i class="fas fa-star"></i> 4.8 <span
                                    class="text-[#CCCCCC] font-normal">({{ $logement->avis->count() }} avis)</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-[65%]">
                    <section class="mb-12">
                        <div
                            class="flex items-center gap-5 mb-10 p-6 bg-white border border-[#EEEEEE] rounded-2xl shadow-sm">
                            <img src="https://ui-avatars.com/api/?name={{ $logement->user->name }}&background=445EF2&color=fff&bold=true"
                                class="w-14 h-14 rounded-xl object-cover">
                            <div>
                                <h3 class="text-base font-black text-[#010E26]">Hébergé par {{ $logement->user->name }}
                                </h3>
                                <p class="text-xs text-[#999999] font-bold uppercase tracking-wider">Hôte vérifié •
                                    Membre depuis 2024</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-12">
                            @php
                                $features = [
                                    ['icon' => 'fa-home', 'label' => 'Type', 'val' => ucfirst($logement->type)],
                                    ['icon' => 'fa-bed', 'label' => 'Chambres', 'val' => '2 Pièces'],
                                    ['icon' => 'fa-expand-arrows-alt', 'label' => 'Surface', 'val' => '65m²'],
                                    [
                                        'icon' => 'fa-user-check',
                                        'label' => 'Status',
                                        'val' => 'Libre',
                                        'color' => 'text-green-600',
                                    ],
                                ];
                            @endphp
                            @foreach ($features as $f)
                                <div
                                    class="p-5 bg-white border border-[#EEEEEE] rounded-2xl text-center hover:border-[#445EF2] transition-colors group">
                                    <i
                                        class="fas {{ $f['icon'] }} text-[#445EF2] text-lg mb-3 opacity-80 group-hover:scale-110 transition-transform"></i>
                                    <p class="text-[10px] uppercase tracking-widest font-black text-[#999999] mb-1">
                                        {{ $f['label'] }}</p>
                                    <p class="text-sm font-bold {{ $f['color'] ?? '' }}">{{ $f['val'] }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="prose prose-slate max-w-none">
                            <h4 class="text-xl font-black mb-4">À propos de ce logement</h4>
                            <p class="text-[#666666] text-base leading-relaxed whitespace-pre-line">
                                {{ $logement->description }}
                            </p>
                        </div>
                    </section>

                    <hr class="border-[#EEEEEE] my-10">

                    <section id="reviews">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-xl font-black">Avis & Expériences</h3>
                            @if (auth()->user()->role == 'student')
                                <button onclick="document.getElementById('avis-form').classList.toggle('hidden')"
                                    class="text-[#445EF2] font-black text-xs uppercase tracking-widest hover:underline">
                                    Écrire un avis
                                </button>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse($logement->avis as $avis)
                                <div class="p-6 bg-white border border-[#EEEEEE] rounded-2xl shadow-sm">
                                    <div class="flex items-center gap-3 mb-4">
                                        <img src="https://ui-avatars.com/api/?name={{ $avis->user->name }}&background=F8F9FA&color=445EF2"
                                            class="w-10 h-10 rounded-full">
                                        <div class="flex-1">
                                            <h5 class="text-sm font-black">{{ $avis->user->name }}</h5>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase">
                                                {{ $avis->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="flex text-yellow-400 text-xs">
                                            @for ($i = 0; $i < $avis->note; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-[#666666] text-sm leading-relaxed italic">"{{ $avis->commentaire }}"
                                    </p>
                                </div>
                            @empty
                                <p
                                    class="text-sm text-gray-400 italic bg-white p-6 rounded-2xl border border-dashed border-[#EEEEEE]">
                                    Aucun avis pour le moment.</p>
                            @endforelse
                        </div>
                    </section>
                </div>

                <aside class="lg:w-[35%]">
                    <div class="sticky top-10 bg-white rounded-[2.5rem] p-8 shadow-sm border border-[#EEEEEE]">
                        <div class="flex justify-between items-end mb-8">
                            <div>
                                <span class="text-xs font-black text-[#999999] uppercase tracking-widest">Loyer
                                    Mensuel</span>
                                <p class="text-4xl font-black text-[#445EF2] mt-1">
                                    {{ number_format($logement->prix, 0, ',', ' ') }} <span
                                        class="text-sm text-[#010E26] font-bold">DH</span>
                                </p>
                            </div>
                            <div
                                class="bg-green-50 text-green-600 text-[10px] px-3 py-1.5 rounded-lg font-black uppercase border border-green-100">
                                Disponible</div>
                        </div>

                        @if (auth()->user()->role == 'student')
                            <form action="{{ route('reservations.store', $logement) }}" method="POST"
                                class="space-y-5">
                                @csrf
                                <div
                                    class="grid grid-cols-2 gap-px bg-[#EEEEEE] rounded-2xl overflow-hidden border border-[#EEEEEE]">
                                    <div class="bg-white p-4">
                                        <label
                                            class="block text-[10px] font-black text-[#999999] uppercase mb-1">Arrivée</label>
                                        <input type="date" name="date_debut" required
                                            class="w-full text-sm font-bold border-none p-0 focus:ring-0">
                                    </div>
                                    <div class="bg-white p-4">
                                        <label
                                            class="block text-[10px] font-black text-[#999999] uppercase mb-1">Départ</label>
                                        <input type="date" name="date_fin" required
                                            class="w-full text-sm font-bold border-none p-0 focus:ring-0">
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full bg-[#445EF2] hover:bg-[#010E26] text-white py-5 rounded-2xl font-black text-sm transition-all uppercase tracking-widest shadow-lg shadow-blue-100 active:scale-95">
                                    Réserver maintenant
                                </button>
                            </form>

                            <div class="mt-5">
                                <a href="{{ route('messages.show', $logement->user) }}"
                                    class="w-full flex items-center justify-center gap-2 border-2 border-[#010E26] py-4 rounded-2xl font-black text-xs uppercase hover:bg-[#010E26] hover:text-white transition-all">
                                    <i class="far fa-comment-alt text-base"></i> Contacter l'hôte
                                </a>
                            </div>
                        @else
                            <div
                                class="p-8 bg-[#F8F9FA] rounded-[2rem] border-2 border-dashed border-[#EEEEEE] text-center">
                                <p class="text-[#010E26] font-black uppercase text-xs tracking-widest">Gestion Annonce
                                </p>
                                <a href="#"
                                    class="inline-block mt-4 text-[#445EF2] font-bold text-sm underline underline-offset-4">Modifier
                                    les informations</a>
                            </div>
                        @endif

                        <div class="mt-8 text-center border-t border-[#F8F9FA] pt-6">
                            <p
                                class="text-[11px] text-[#BBBBBB] font-bold uppercase flex items-center justify-center gap-2">
                                <i class="fas fa-shield-alt text-green-400"></i> Paiement 100% Sécurisé
                            </p>
                        </div>
                    </div>
                </aside>
            </div>
        </main>
    </div>
</x-app-layout>
