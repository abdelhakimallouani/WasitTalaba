<nav x-data="{ open: false }" class="absolute top-0 left-0 w-full z-50 bg-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <div class="flex items-center gap-10">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="bg-indigo-600 p-1.5 rounded-lg shadow-lg">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold text-white tracking-tight">Wasit Talaba</span>
                </a>

                <div class="hidden space-x-8 sm:flex">
                    <a href="#" class="text-white/90 hover:text-white font-medium transition">Opportunities</a>
                    <a href="#" class="text-white/90 hover:text-white font-medium transition">Housing</a>
                    <a href="#" class="text-white/90 hover:text-white font-medium transition">Services</a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center gap-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-white/20 hover:bg-white/30 backdrop-blur-md rounded-full border border-white/30 transition">
                                {{ auth()->user()->name }}
                                <i class="fas fa-chevron-down ml-2 text-[10px]"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-white font-medium px-6 py-2 hover:bg-white/20 hover:text-indigo-200 transition">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-white text-indigo-700 font-bold shadow-xl hover:bg-indigo-50 ">
                        Register
                    </a>
                @endauth
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-white hover:bg-white/10">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>