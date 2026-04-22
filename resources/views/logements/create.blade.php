<x-app-layout>
    <!-- Navbar Spacer -->
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md flex items-center px-8">
    </div>

    <div class="max-w-5xl mx-auto pt-28 pb-12 px-4 sm:px-6">
        
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Ajouter un Logement</h1>
            <p class="text-gray-500 mt-1">Remplissez les détails pour publier votre nouvelle annonce.</p>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700  flex items-center gap-3">
                <i class="fas fa-check-circle"></i>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('logements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Section 1: Infos Générales -->
            <div class="bg-white border border-gray-100  p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-50 pb-4">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-[#445EF2]">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Informations Générales</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-[13px] font-black text-gray-600 uppercase tracking-[0.1em] mb-2">Titre de l'annonce</label>
                        <input type="text" name="titre" value="{{ old('titre') }}" 
                               class="w-full bg-gray-50 border border-gray-300  p-4 text-gray-800 focus:ring-[#445EF2]/20 placeholder-gray-300"
                               placeholder="Ex: Studio moderne près de l'université">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[13px] font-black text-gray-600 uppercase tracking-[0.1em] mb-2">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full bg-gray-50 border border-gray-300  p-4 text-gray-800 focus:ring-[#445EF2]/20 placeholder-gray-300"
                                  placeholder="Décrivez les atouts de votre logement...">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[13px] font-black text-gray-600 uppercase tracking-[0.1em] mb-2">Prix (DH / mois)</label>
                        <div class="relative">
                            <input type="number" name="prix" value="{{ old('prix') }}" 
                                   class="w-full bg-gray-50 border border-gray-300  p-4 pl-12 text-gray-800 focus:ring-[#445EF2]/20">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 font-bold">DH</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[13px] font-black text-gray-600 uppercase tracking-[0.1em] mb-2">Type de logement</label>
                        <select name="type" class="w-full bg-gray-50 border border-gray-300  p-4 text-gray-800 focus:ring-[#445EF2]/20">
                            <option value="appartement" {{ old('type') == 'appartement' ? 'selected' : '' }}>Appartement</option>
                            <option value="chambre" {{ old('type') == 'chambre' ? 'selected' : '' }}>Chambre</option>
                            <option value="studio" {{ old('type') == 'studio' ? 'selected' : '' }}>Studio</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 2: Localisation -->
            <div class="bg-white border border-gray-100  p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-50 pb-4">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center text-orange-500">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Localisation</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[13px] font-black text-gray-600 uppercase tracking-[0.1em] mb-2">Ville</label>
                        <input type="text" name="ville" value="{{ old('ville') }}" 
                               class="w-full bg-gray-50 border border-gray-300  p-4 text-gray-800 focus:ring-[#445EF2]/20 placeholder-gray-300 "
                               placeholder="Ex: Casablanca">
                    </div>
                    <div>
                        <label class="block text-[13px] font-black text-gray-600 uppercase tracking-[0.1em] mb-2">Adresse</label>
                        <input type="text" name="adresse" value="{{ old('adresse') }}" 
                               class="w-full bg-gray-50 border border-gray-300  p-4 text-gray-800 focus:ring-[#445EF2]/20 placeholder-gray-300 "
                               placeholder="Numéro et rue">
                    </div>
                    <div>
                        <label class="block text-[13px] font-black text-gray-600 uppercase tracking-[0.1em] mb-2">Latitude</label>
                        <input type="text" name="latitude" value="{{ old('latitude') }}" 
                               class="w-full bg-gray-50 border border-gray-300  p-4 text-gray-800 focus:ring-[#445EF2]/20">
                    </div>
                    <div>
                        <label class="block text-[13px] font-black text-gray-600 uppercase tracking-[0.1em] mb-2">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude') }}" 
                               class="w-full bg-gray-50 border border-gray-300  p-4 text-gray-800 focus:ring-[#445EF2]/20">
                    </div>
                </div>
            </div>

            <!-- Section 3: Médias -->
            <div class="bg-white border border-gray-100  p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-50 pb-4">
                    <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600">
                        <i class="fas fa-images"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Photos du logement</h3>
                </div>

                <div class="relative border-2 border-dashed border-gray-200 p-10 text-center hover:border-[#445EF2] group">
                    <input type="file" name="images[]" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="space-y-2">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-300 group-hover:text-[#445EF2] transition-colors"></i>
                        <p class="text-gray-500 font-medium">Cliquez ou glissez vos photos ici</p>
                        <p class="text-xs text-gray-600 uppercase font-black">PNG, JPG jusqu'à 10MB</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-[#445EF2] text-white font-black py-5 shadow-xl shadow-blue-200 hover:bg-blue-700 active:scale-[0.98] uppercase tracking-widest text-sm">
                    Publier l'annonce
                </button>
            </div>

        </form>
    </div>
</x-app-layout>