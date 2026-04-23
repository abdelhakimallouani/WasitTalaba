<x-app-layout>
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md"></div>
    <div class="min-h-screen bg-[#F8FAFC] p-8 mt-14">

        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight ">Admin <span class="text-[#445EF2]">Panel</span></h1>
                <p class="text-slate-500 font-medium">Vue d'ensemble de la plateforme WasiT Talaba</p>
            </div>
            
            <!-- Barre de recherche stylisée -->
            <form method="GET" class="relative group">
                <input type="text" name="search" value="{{ $search }}" 
                       placeholder="Rechercher un utilisateur..."
                       class="w-full md:w-80 bg-white border-none rounded-2xl py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-[#445EF2]/20 transition-all">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-[#445EF2]"></i>
                <button type="submit" class="hidden"></button>
            </form>
        </div>

        <!-- 🔢 Stats Générales -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-blue-50 text-[#445EF2] rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-widest">Utilisateurs</p>
                    <h2 class="text-2xl font-black text-slate-900">{{ $usersCount }}</h2>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-home"></i>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-widest">Logements</p>
                    <h2 class="text-2xl font-black text-slate-900">{{ $logementsCount }}</h2>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-widest">Messages</p>
                    <h2 class="text-2xl font-black text-slate-900">{{ $messagesCount }}</h2>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white p-6 shadow-sm border border-slate-100 flex items-center gap-5">
                <div class="w-14 h-14 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-heart"></i>
                </div>
                <div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-widest">Favoris</p>
                    <h2 class="text-2xl font-black text-slate-900">{{ $favorisCount }}</h2>
                </div>
            </div>
        </div>

        <!-- 🏠 Section Réservations (Couleurs Soft) -->
        <div class="mb-10">
            <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-2">État des réservations</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Pending -->
                <div class="bg-amber-50/50 border border-amber-100 p-6">
                    <div class="flex justify-between items-start">
                        <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse mt-2"></span>
                        <h2 class="text-3xl font-black text-amber-700">{{ $pendingCount }}</h2>
                    </div>
                    <p class="text-amber-600/80 font-bold text-sm uppercase">En attente</p>
                </div>

                <!-- Accepted -->
                <div class="bg-emerald-50/50 border border-emerald-100 p-6">
                    <div class="flex justify-between items-start">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full mt-2"></span>
                        <h2 class="text-3xl font-black text-emerald-700">{{ $acceptedCount }}</h2>
                    </div>
                    <p class="text-emerald-600/80 font-bold text-sm uppercase">Acceptées</p>
                </div>

                <!-- Rejected -->
                <div class="bg-rose-50/50 border border-rose-100 p-6">
                    <div class="flex justify-between items-start">
                        <span class="w-2 h-2 bg-rose-400 rounded-full mt-2"></span>
                        <h2 class="text-3xl font-black text-rose-700">{{ $rejectedCount }}</h2>
                    </div>
                    <p class="text-rose-600/80 font-bold text-sm uppercase">Refusées</p>
                </div>

                <!-- Total -->
                <div class="bg-slate-900 p-6 shadow-xl shadow-slate-200">
                    <h2 class="text-3xl font-black text-white leading-none">{{ $pendingCount + $acceptedCount + $rejectedCount }}</h2>
                    <p class="text-slate-400 font-bold text-sm uppercase mt-2">Total Réservations</p>
                </div>
            </div>
        </div>

        <!-- 👥 Table des Utilisateurs -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900 italic">Liste des Utilisateurs</h3>
                <span class="text-xs font-bold text-slate-400 bg-slate-50 px-3 py-1 rounded-full">{{ $users->total() }} au total</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-slate-50">
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nom</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Email</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Rôle</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center font-bold text-slate-500 text-xs">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <span class="font-bold text-slate-700">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-slate-500 font-medium">{{ $user->email }}</td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 text-[10px] font-black uppercase rounded-lg 
                                        {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="#" class="w-8 h-8 rounded-lg flex items-center justify-center text-blue-500 hover:bg-blue-50 transition-all">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <form method="POST" action="#" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                            @csrf @method('DELETE')
                                            <button class="w-8 h-8 rounded-lg flex items-center justify-center text-rose-500 hover:bg-rose-50 transition-all">
                                                <i class="fas fa-trash-alt text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-user-slash text-4xl text-slate-200 mb-4"></i>
                                        <p class="text-slate-400 font-bold italic tracking-tight">Aucun utilisateur trouvé</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Stylisée -->
            <div class="p-8 bg-slate-50/50 border-t border-slate-50">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>