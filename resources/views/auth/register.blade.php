<x-app-layout>
    <div class="relative min-h-screen w-full flex flex-col overflow-x-hidden">
        
        <div class="relative z-30 shrink-0">
            @include('layouts.navigation')
        </div>

        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=1400&auto=format&fit=crop" 
                 class="w-full h-full object-cover" 
                 alt="Background">
            <div class="absolute inset-0 bg-slate-900/50"></div>
        </div>

        <main class="relative z-20 flex-1 flex flex-col lg:flex-row-reverse w-full items-center">
            
            <div class="w-full lg:w-1/3 flex flex-col justify-center px-8 lg:px-12 text-white py-8">
                <h2 class="text-4xl lg:text-5xl font-black mb-4 leading-tight">
                    Rejoignez <br>
                    <span class="text-indigo-400">WasiT Talaba</span>
                </h2>
                <p class="text-lg text-slate-200 max-w-sm opacity-90">
                    Trouvez le logement idéal en quelques clics.
                </p>
            </div>

            <div class="w-full lg:w-2/3 flex items-center justify-center p-4 lg:p-8">
                <div class="w-full max-w-5xl bg-white/10 backdrop-blur-xl border border-white/20 p-8 lg:p-10 shadow-2xl">
                    
                    <div class="mb-6 justify-center text-center">
                        <h1 class="text-3xl font-extrabold text-white">Inscription</h1>
                        <p class="text-white/60 text-sm font-medium">Créez votre compte rapidement</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                            
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-white/80 ml-1 uppercase">Nom Complet</label>
                                <input id="name" type="text" name="name" :value="old('name')" required autofocus
                                    class="w-full px-5 py-3 bg-white/5 border border-white/10 text-white placeholder:text-white/20 focus:bg-white/10 focus:border-indigo-400 focus:ring-0 transition-all outline-none"
                                    placeholder="votre nom ...">
                                <x-input-error :messages="$errors->get('name')" class="text-red-300 text-[10px]" />
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-bold text-white/80 ml-1 uppercase">Email</label>
                                <input id="email" type="email" name="email" :value="old('email')" required
                                    class="w-full px-5 py-3 bg-white/5 border border-white/10 text-white placeholder:text-white/20 focus:bg-white/10 focus:border-indigo-400 focus:ring-0 transition-all outline-none"
                                    placeholder="votre@email.com">
                                <x-input-error :messages="$errors->get('email')" class="text-red-300 text-[10px]" />
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-bold text-white/80 ml-1 uppercase">Mot de passe</label>
                                <input id="password" type="password" name="password" required
                                    class="w-full px-5 py-3 bg-white/5 border border-white/10 text-white placeholder:text-white/20 focus:bg-white/10 focus:border-indigo-400 focus:ring-0 transition-all outline-none"
                                    placeholder="••••••••">
                                <x-input-error :messages="$errors->get('password')" class="text-red-300 text-[10px]" />
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-bold text-white/80 ml-1 uppercase">Confirmation</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    class="w-full px-5 py-3 bg-white/5 border border-white/10 text-white placeholder:text-white/20 focus:bg-white/10 focus:border-indigo-400 focus:ring-0 transition-all outline-none"
                                    placeholder="••••••••">
                            </div>

                            <div class="space-y-1 md:col-span-2">
                                <label class="text-xs font-bold text-white/80 ml-1 uppercase">Vous êtes ?</label>
                                <select name="role" id="role" required
                                    class="w-full px-5 py-3 bg-white/5 border border-white/10 text-white focus:bg-white/10 focus:border-indigo-400 focus:ring-0 transition-all outline-none appearance-none cursor-pointer">
                                    <option value="" class="bg-slate-900 text-white">-- Choisir --</option>
                                    <option value="student" class="bg-slate-900 text-white">Étudiant</option>
                                    <option value="owner" class="bg-slate-900 text-white">Propriétaire</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-4 flex flex-col items-center gap-8">
                            <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-lg shadow-xl transition-all transform active:scale-[0.98]">
                                Créer mon compte
                            </button>
                            <p class="w-full md:w-1/2 text-center text-white/60 text-sm">
                                Déjà inscrit ? 
                                <a href="{{ route('login') }}" class="text-white font-bold hover:underline">Se connecter</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>