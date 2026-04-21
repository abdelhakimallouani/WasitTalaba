<x-app-layout>
    <!-- FIX: Had l'div hua li ghadi ykhalli l'navbar dima bayna nqiya b l'blue dyalha -->
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md"></div>

    <!-- Padding-top bach l'content maykonch mghatti b l'navbar -->
    <div class="max-w-7xl mx-auto pt-24 pb-8 px-4">

        <!-- 1. Galerie d tsawer (Same design as your image) -->
        <div class="grid grid-cols-12 gap-3 h-[450px] mb-10 overflow-hidden rounded-2xl shadow-sm">
            <!-- Image Principale -->
            <div class="col-span-8 h-full">
                @php $firstImage = $logement->images->first(); @endphp
                <img src="{{ $firstImage ? asset('storage/' . $firstImage->image_path) : 'https://via.placeholder.com/800x500' }}"
                    class="w-full h-full object-cover hover:opacity-95 transition cursor-pointer">
            </div>
            <!-- Images Secondaires -->
            <div class="col-span-4 flex flex-col gap-3 h-full">
                <div class="h-1/2 overflow-hidden">
                    <img src="{{ isset($logement->images[1]) ? asset('storage/' . $logement->images[1]->image_path) : 'https://via.placeholder.com/400x300' }}"
                        class="w-full h-full object-cover hover:opacity-95 transition cursor-pointer">
                </div>
                <div class="h-1/2 overflow-hidden">
                    <img src="{{ isset($logement->images[2]) ? asset('storage/' . $logement->images[2]->image_path) : 'https://via.placeholder.com/400x300' }}"
                        class="w-full h-full object-cover hover:opacity-95 transition cursor-pointer">
                </div>
            </div>
        </div>

        <!-- 2. Grid Content & Sticky Reservation -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <!-- Jiha d l'issar: Info Logement -->
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between border-b pb-6 mb-6">
                    <div>
                        <h2 class="text-xl font-semibold italic text-gray-800 tracking-tight">Logement proposé par {{ $logement->user->name }}</h2>
                        <p class="text-gray-500">{{ $logement->type }} • {{ $logement->ville }}</p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold shadow-md">
                        {{ strtoupper(substr($logement->user->name, 0, 1)) }}
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-bold mb-3 flex items-center gap-2 text-gray-900">
                        <i class="fas fa-map-marker-alt text-red-500"></i> Adresse
                    </h3>
                    <p class="text-gray-600 bg-gray-50 p-3 rounded-lg border border-gray-100 italic">
                        {{ $logement->adresse }}
                    </p>
                </div>

                <div class="border-b pb-8 mb-8">
                    <h3 class="text-lg font-bold mb-3 text-gray-900">À propos de ce logement</h3>
                    <p class="text-gray-600 leading-7 whitespace-pre-line text-lg">
                        {{ $logement->description }}
                    </p>
                </div>

                <!-- Section Avis -->
                <div class="mt-10">
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-yellow-400"></i>
                        Avis des locataires ({{ $logement->avis->count() }})
                    </h3>

                    @forelse($logement->avis as $avis)
                        <div class="mb-6 p-5 bg-gray-50 rounded-2xl border border-gray-100 shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-gray-700">{{ $avis->user->name }}</span>
                                <span class="text-sm text-yellow-600 font-bold tracking-tighter">{{ $avis->note }} ⭐</span>
                            </div>
                            <p class="text-gray-600 text-sm italic leading-relaxed">" {{ $avis->commentaire }} "</p>
                        </div>
                    @empty
                        <p class="text-gray-400">Pas encore d'avis sur ce logement.</p>
                    @endforelse

                    @if (auth()->user()->role == 'student')
                        <div class="mt-8 p-6 bg-white border border-indigo-100 rounded-2xl shadow-md">
                            <h4 class="font-bold text-indigo-900 mb-4 uppercase text-xs tracking-widest italic">Laissez votre expérience</h4>
                            <form action="{{ route('avis.store', $logement->id) }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-medium text-gray-600">Note :</span>
                                    <select name="note" class="rounded-lg border-gray-200 text-sm focus:ring-indigo-500">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}">{{ $i }} ⭐</option>
                                        @endfor
                                    </select>
                                </div>
                                <textarea name="commentaire" placeholder="Comment s'est passé votre séjour ?"
                                    class="w-full rounded-xl border-gray-200 text-sm h-28 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50"></textarea>
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                                    Publier l'avis
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Jiha d l'imn: Carte de Réservation (Sticky) -->
            <div class="lg:col-span-1">
                <div class="sticky top-28 p-6 bg-white border border-gray-200 rounded-3xl shadow-2xl shadow-gray-200/50">
                    <div class="flex justify-between items-baseline mb-6">
                        <span class="text-3xl font-black text-gray-900">{{ $logement->prix }} DH</span>
                        <span class="text-gray-500 text-sm font-medium">/ mois</span>
                    </div>

                    @if (auth()->user()->role == 'student')
                        <form action="{{ route('reservations.store', $logement) }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="border border-gray-300 rounded-xl overflow-hidden">
                                <div class="p-3 border-b flex flex-col bg-white">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Arrivée</label>
                                    <input type="date" name="date_debut"
                                        class="border-none p-0 focus:ring-0 text-sm font-bold w-full text-gray-700" required>
                                </div>
                                <div class="p-3 flex flex-col bg-white">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Départ</label>
                                    <input type="date" name="date_fin"
                                        class="border-none p-0 focus:ring-0 text-sm font-bold w-full text-gray-700" required>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-[#FF385C] hover:bg-[#E31C5F] text-white py-4 rounded-2xl font-black text-lg transition-all shadow-xl active:scale-95 shadow-pink-100">
                                Réserver maintenant
                            </button>
                        </form>

                        <div class="mt-4 text-center">
                            <p class="text-[11px] text-gray-400 mb-4 italic">Confirmation rapide par le propriétaire</p>
                            <a href="{{ route('messages.show', $logement->user) }}"
                                class="inline-flex items-center gap-2 text-sm font-bold text-gray-700 hover:text-indigo-600 transition underline underline-offset-4 decoration-gray-300">
                                <i class="far fa-comment-dots"></i> Contacter l'propriétaire
                            </a>
                        </div>
                    @else
                        <div class="py-5 px-3 bg-indigo-50 rounded-2xl border-2 border-dashed border-indigo-200 text-center">
                            <p class="text-sm font-bold text-indigo-700 italic">Vous êtes le propriétaire de ce logement</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>