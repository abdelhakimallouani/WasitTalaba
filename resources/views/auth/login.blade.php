<x-app-layout>
    <div class="relative h-screen w-full flex flex-col overflow-hidden">
        
        <div class="relative z-30 shrink-0">
            @include('layouts.navigation')
        </div>

        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=1400&auto=format&fit=crop" 
                 class="w-full h-full object-cover" 
                 alt="Background">
            <div class="absolute inset-0 bg-slate-900/50"></div>
        </div>

        <main class="relative z-20 flex-1 flex flex-col lg:flex-row w-full h-full">
            
            <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 lg:px-20 text-white">
                <h2 class="text-5xl lg:text-6xl font-black mb-6 leading-tight">
                    Content de vous revoir sur <br>
                    <span class="text-indigo-400">WasiT Talaba</span>
                </h2>
                <p class="text-xl text-slate-200 max-w-md">
                    Connectez-vous pour accéder à vos annonces et gérer vos recherches en un clin d'œil.
                </p>
            </div>

            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-20">
                <div class="w-full  bg-white/10 backdrop-blur-xl border border-white/20 p-10 shadow-2xl">
                    
                    <div class="mb-10 justify-center text-center">
                        <h1 class="text-3xl font-bold text-white">Connexion</h1>
                        <p class="text-white/60 mt-2">Accédez à votre compte</p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-7">
                        @csrf

                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-white/80 ml-1">Email</label>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                                class="w-full px-5 py-4 bg-white/5 border border-white/20 text-white placeholder:text-white/30 focus:bg-white/10 focus:border-indigo-400 focus:ring-0 transition-all outline-none"
                                placeholder="votre@email.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-300" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <div class="flex justify-between items-center ml-1">
                                <label class="text-sm font-bold text-white/80">Mot de passe</label>
                                @if (Route::has('password.request'))
                                    <a class="text-xs font-bold text-indigo-300 hover:text-white transition-colors" href="{{ route('password.request') }}">Oublié ?</a>
                                @endif
                            </div>
                            <input id="password" type="password" name="password" required
                                class="w-full px-5 py-4 bg-white/5 border border-white/20 text-white placeholder:text-white/30 focus:bg-white/10 focus:border-indigo-400 focus:ring-0 transition-all outline-none"
                                placeholder="••••••••">
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-300" />
                        </div>

                        <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold shadow-lg transition-all transform active:scale-[0.98]">
                            Se connecter
                        </button>

                        <p class="text-center text-white/60 text-sm mt-6">
                            Nouveau ici ? 
                            <a href="{{ route('register') }}" class="text-white font-bold hover:underline">Créer un compte</a>
                        </p>
                    </form>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>