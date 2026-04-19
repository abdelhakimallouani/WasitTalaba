<header class="relative min-h-[650px] w-full flex flex-col items-center justify-center overflow-hidden">
    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=2000" 
         class="absolute inset-0 w-full h-full object-cover" alt="Hero Background">
    <div class="absolute inset-0 bg-slate-900/50"></div>

    <div class="relative z-10 text-center px-4 pt-16">
        <span class="inline-block bg-white/10 backdrop-blur-md text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-[0.2em] mb-6 border border-white/20">
            #1 Student Platform 2026
        </span>
        
        <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight">
            Find Your Place <br> 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 to-purple-300">Of Future.</span>
        </h1>
        
        <p class="text-white/80 max-w-2xl mx-auto text-lg mb-12">
            Connecting students with verified internships, housing, and academic services.
        </p>

        <div class="bg-white p-2 rounded-2xl md:rounded-full shadow-2xl flex flex-col md:flex-row gap-2 w-full max-w-4xl mx-auto border border-white/20">
            <div class="flex-1 flex items-center px-6 py-3 border-b md:border-b-0 md:border-r border-gray-100">
                <i class="fas fa-search text-indigo-500 mr-4 text-lg"></i>
                <div class="text-left w-full">
                    <label class="block text-[10px] uppercase font-bold text-gray-400">What are you looking for?</label>
                    <input type="text" placeholder="Internships, Rooms..." class="w-full outline-none text-gray-700 font-semibold bg-transparent">
                </div>
            </div>
            
            <div class="flex-1 flex items-center px-6 py-3 border-b md:border-b-0 md:border-r border-gray-100">
                <i class="fas fa-map-marker-alt text-indigo-500 mr-4 text-lg"></i>
                <div class="text-left w-full">
                    <label class="block text-[10px] uppercase font-bold text-gray-400">Location</label>
                    <select class="w-full outline-none text-gray-700 font-semibold bg-transparent appearance-none cursor-pointer">
                        <option>Casablanca, Marocco</option>
                        <option>Rabat</option>
                        <option>Marrakech</option>
                    </select>
                </div>
            </div>

            <button class="bg-indigo-600 text-white px-10 py-4 rounded-xl md:rounded-full font-bold hover:bg-indigo-700 transition-all flex items-center justify-center gap-3 active:scale-95">
                <i class="fas fa-search"></i>
                Search
            </button>
        </div>
    </div>
</header>