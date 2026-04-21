<x-app-layout>
    <!-- Navbar Overlay Fix -->
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md"></div>

    <div class="flex h-full mt-20 overflow-hidden bg-white">
        
        <!-- Sidebar (Inbox) -->
        <div class="w-1/4 flex flex-col border-r border-gray-100 bg-[#F9FAFB]">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Your Inbox</h1>
                <div class="mt-4 relative">
                    <input type="text" placeholder="Search visitor" 
                           class="w-full bg-gray-100 border-none rounded-xl py-2 pl-10 text-sm focus:ring-1 focus:ring-gray-300">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto px-2">
                @foreach($users as $u)
                    <a href="{{ route('messages.show', $u) }}" 
                       class="flex items-center gap-3 p-4 mb-1 rounded-2xl transition-all hover:bg-white hover:shadow-sm group">
                        <div class="relative">
                            <img src="https://ui-avatars.com/api/?name={{ $u->name }}&background=random" class="w-12 h-12 rounded-full border-2 border-white shadow-sm">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-baseline">
                                <p class="font-bold text-sm text-gray-800 truncate">{{ $u->name }}</p>
                                <span class="text-[10px] text-gray-400 font-medium tracking-tighter">09:54 am</span>
                            </div>
                            <p class="text-xs text-gray-500 truncate italic">Click to open chat...</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Chat Area (Empty) -->
        <div class="w-3/4 flex flex-col items-center justify-center bg-white text-center p-10">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                <i class="far fa-comments text-3xl text-gray-200"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-300 uppercase tracking-widest">Select a conversation</h2>
            <p class="text-gray-400 text-sm mt-2">Choose a person from the left to start messaging.</p>
        </div>
    </div>
</x-app-layout>