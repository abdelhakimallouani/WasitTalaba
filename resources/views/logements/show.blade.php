<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .mySwiper {
            width: 100%;
            height: 600px;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper-pagination-bullet-active {
            background: #445EF2
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #445EF2;
            width: 45px height: 45px border-radius: 50%;

            after {
                font-size: 18px font-weight: bold;
            }
        }
    </style>

    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md"></div>

    <div class="max-w-7xl mx-auto pt-24 pb-12 px-4">

        <div class="relative mb-10 group">
            <div class="swiper mySwiper shadow-xl">
                <div class="swiper-wrapper">
                    @forelse($logement->images as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image du logement"
                                class="cursor-pointer transition-transform duration-700">
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <img src="https://via.placeholder.com/1200x600?text=Aucune+image" class="object-cover">
                        </div>
                    @endforelse
                </div>

                <div class="swiper-button-next opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="swiper-button-prev opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <div class="lg:col-span-2">
                <div class="flex items-center justify-between border-b pb-6 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 tracking-tight ">
                            Logement proposé par {{ $logement->user->name }}
                        </h2>
                        <p class="text-gray-500 font-medium mt-1">{{ $logement->type }} • {{ $logement->ville }}</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-xl shadow-lg border-2 border-white">
                        {{ strtoupper(substr($logement->user->name, 0, 1)) }}
                    </div>
                </div>

                <div class="mb-8 bg-gray-50 p-5  border border-gray-100">
                    <h3 class="text-lg font-bold mb-3 flex items-center gap-2 text-gray-900">
                        <i class="fas fa-map-marker-alt text-red-500"></i> Adresse complète
                    </h3>
                    <p class="text-gray-600 ">
                        {{ $logement->adresse }}
                    </p>
                </div>

                <div class="border-b pb-8 mb-8">
                    <h3 class="text-lg font-bold mb-4 text-gray-900">À propos de ce logement</h3>
                    <p class="text-gray-600 leading-8 whitespace-pre-line text-lg ">
                        {{ $logement->description }}
                    </p>
                </div>

                @if (auth()->user()->role == 'student')
                    <div class="mt-8 p-8 bg-indigo-50/50 border border-indigo-100">
                        <h4 class="font-black text-indigo-900 mb-6 uppercase text-xs tracking-[0.2em]">Partagez votre
                            avis</h4>
                        <form action="{{ route('avis.store', $logement->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="flex items-center gap-4">
                                <label class="text-sm font-bold text-gray-700 ">Votre note :</label>
                                <select name="note"
                                    class="rounded-xl border-none shadow-sm text-sm focus:ring-2 focus:ring-indigo-500">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}">{{ $i }} Étoiles</option>
                                    @endfor
                                </select>
                            </div>
                            <textarea name="commentaire" placeholder="Comment s'est passé votre séjour ?"
                                class="w-full  border-none shadow-sm text-sm h-32 focus:ring-2 focus:ring-indigo-500 bg-white px-4 py-3"></textarea>
                            <div class="flex justify-end items-centre">
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-10 py-3  font-bold text-sm hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 active:scale-95">
                                    Publier l'avis
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
                <div class="mt-10">
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-yellow-400"></i>
                        Avis des locataires ({{ $logement->avis->count() }})
                    </h3>

                    @forelse($logement->avis as $avis)
                        <div class="mb-6 p-5 bg-white  border border-gray-100 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-bold text-gray-800">{{ $avis->user->name }}</span>
                                <span class="px-3 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs font-bold">
                                    {{ $avis->note }} / 5 ⭐
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed  border-l-4 border-indigo-100 pl-4">
                                "{{ $avis->commentaire }}"
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-400 ">Soyez le premier à laisser un avis.</p>
                    @endforelse

                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-28 p-8 bg-white border border-gray-100 shadow-2xl shadow-gray-200/60">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <span class="text-3xl font-black text-gray-900">{{ $logement->prix }} DH</span>
                            <span class="text-gray-400 text-sm font-medium"> / mois</span>
                        </div>
                    </div>

                    @if (auth()->user()->role == 'student')
                        <form action="{{ route('reservations.store', $logement) }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="border-2 border-gray-50  overflow-hidden bg-gray-50">
                                <div class="p-4 border-b border-white flex flex-col">
                                    <label
                                        class="text-[10px] font-black text-gray-400 uppercase tracking-tighter mb-1">Date
                                        d'Arrivée</label>
                                    <input type="date" name="date_debut"
                                        class="bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-gray-800 w-full cursor-pointer"
                                        required>
                                </div>
                                <div class="p-4 flex flex-col">
                                    <label
                                        class="text-[10px] font-black text-gray-400 uppercase tracking-tighter mb-1">Date
                                        de Départ</label>
                                    <input type="date" name="date_fin"
                                        class="bg-transparent border-none p-0 focus:ring-0 text-sm font-bold text-gray-800 w-full cursor-pointer"
                                        required>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-green-500 hover:bg-green-600 text-white py-3  font-black text-lg transition-all shadow-xl shadow-pink-100 active:scale-[0.98]">
                                Réserver maintenant
                            </button>
                        </form>

                        <div class="mt-6 text-center">
                            <p class="text-[12px] text-gray-400 mb-6 ">Paiement sécurisé après confirmation</p>
                            <a href="{{ route('messages.show', $logement->user) }}"
                                class="inline-flex items-center gap-2 text-sm font-bold text-gray-600 hover:text-black transition-all border-b-2 border-transparent hover:border-gray-800 pb-1">
                                <i class="far fa-comment-dots"></i> Contacter le propriétaire
                            </a>
                        </div>
                    @else
                        <div class="py-6 px-4 bg-indigo-50/50  border-2 border-dashed border-indigo-100 text-center">
                            <p class="text-sm font-black text-indigo-700  uppercase tracking-widest">Votre Annonce
                            </p>
                            <p class="text-xs text-indigo-400 mt-1">Vous gérez cette propriété</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper(".mySwiper", {
                loop: true,
                grabCursor: true,
                keyboard: {
                    enabled: true
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        });
    </script>
</x-app-layout>
