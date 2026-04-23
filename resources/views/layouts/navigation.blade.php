<nav x-data="{ open: false }" class="fixed top-0 left-0 w-full z-50 transition-all duration-300" id="navbar">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-bold text-white">
                Wasit Talaba
            </a>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-white hover:text-white/80">Accueil</a>

                @if (auth()->check() && auth()->user()->role === 'owner')
                    <a href="{{ route('logements.my') }}" class="text-white">Mylogements</a>
                    <a href="{{ route('reservations.index') }}" class="text-white">Reservations</a>
                @else
                    <a href="{{ route('logements.index') }}" class="text-white hover:text-white/80">Logements</a>
                    <a href="{{ route('notifications.index') }}" class="text-white">Notifications</a>
                    <a href="{{ route('favoris.index') }}" class="text-white hover:text-white/80">Favoris</a>
                @endif
                <a href="{{ route('messages.index') }}" class="text-white hover:text-white/80">Messages</a>

            </div>

            <!-- Desktop Auth -->
            <div class="hidden sm:flex sm:items-center gap-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 transition">
                                {{ auth()->user()->name }}
                                <i class="fas fa-chevron-down ml-2 text-[10px]"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 transition duration-300 font-medium 
       {{ request()->routeIs('login') ? 'bg-indigo-700 text-white shadow-inner' : 'text-white hover:bg-white/20' }}">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="px-6 py-2 transition duration-300 font-bold shadow-xl
       {{ request()->routeIs('register') ? 'bg-indigo-50 text-indigo-800' : 'bg-white text-indigo-700 hover:bg-indigo-50' }}">
                        Register
                    </a>
                @endauth
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-white hover:bg-white/10">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- <!-- Mobile Button -->
            <button @click="open = !open" class="sm:hidden text-white focus:outline-none">

                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button> --}}

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition @click.outside="open = false" class="sm:hidden bg-white shadow-lg">

        <div class="flex flex-col p-4 space-y-3">

            <a href="{{ route('home') }}" class="text-gray-700">Accueil</a>

            @if (auth()->user() && auth()->user()->role === 'owner')
                <a href="{{ route('logements.my') }}" class="text-gray-700">Mylogements</a>
                <a href="{{ route('reservations.index') }}" class="text-gray-700">Reservations</a>
            @else
                <a href="{{ route('favoris.index') }}" class="text-gray-700">Favoris</a>
                <a href="{{ route('notifications.index') }}" class="text-gray-700">Notifications</a>
            @endif
            <a href="{{ route('messages.index') }}" class="text-gray-700">Messages</a>

            <hr>

            @auth
                <span class="font-bold text-gray-800">{{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 text-left">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-700">Login</a>
                <a href="{{ route('register') }}" class="text-indigo-600 font-bold">Register</a>
            @endauth

        </div>
    </div>

</nav>
