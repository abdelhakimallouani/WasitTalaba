<x-app-layout>
    <!-- Navbar Fixed -->
    <div class="bg-[#445EF2] fixed top-0 left-0 right-0 z-40 h-20 w-full shadow-md"></div>

    <!-- H-SCREEN + OVERFLOW-HIDDEN: Bach l'page dyal l'browser mat-scrollch ga3 -->
    <div class="flex h-screen pt-20 overflow-hidden bg-white">

        <!-- Sidebar -->
        <div class="w-1/4 flex flex-col border-r border-gray-100 bg-[#F9FAFB] hidden lg:flex">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Your Inbox</h1>
                <div class="mt-4 relative">
                    <input type="text" placeholder="Search visitor"
                        class="w-full bg-gray-100 border-none rounded-xl py-2 pl-10 text-sm focus:ring-1 focus:ring-gray-300">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                </div>
            </div>
            <!-- OVERFLOW-Y-AUTO: Sidebar t-scrolli bouhdha ila kano users bzzaf -->
            <div class="flex-1 overflow-y-auto px-2 mt-2 pb-4">
                @foreach ($users as $u)
                    <a href="{{ route('messages.show', $u) }}"
                        class="flex items-center gap-3 p-4 mb-1 rounded-2xl transition-all {{ $user->id == $u->id ? 'bg-[#E8EFFF] shadow-sm' : 'hover:bg-white' }}">
                        <img src="https://ui-avatars.com/api/?name={{ $u->name }}&background=random"
                            class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <p class="font-bold text-sm {{ $user->id == $u->id ? 'text-[#445EF2]' : 'text-gray-800' }}">
                                {{ $u->name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col bg-white overflow-hidden">
            <!-- Header -->
            <div class="px-8 py-4 border-b flex items-center justify-between bg-white shadow-sm shrink-0">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name={{ $user->name }}" class="w-10 h-10 rounded-full">
                    <div>
                        <h2 class="font-bold text-gray-800">{{ $user->name }}</h2>
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">via Web</span>
                    </div>
                </div>
            </div>

            <!-- MESSAGES LIST: FLEX-COL-REVERSE (Auto-scroll l'te7t) -->
            <!-- L'messages khass i-wslo mn l'Controller m-reiglin b latest() -->
            <div id="chat-box" class="flex-1 overflow-y-auto p-8 bg-[#fdfdfd] flex flex-col-reverse">
                <div class="flex flex-col space-y-8">
                    @foreach ($messages as $msg)
                        @if ($msg->sender_id == auth()->id())
                            <!-- Me -->
                            <div class="flex justify-end items-end gap-2 group">
                                <div class="flex flex-col items-end">
                                    <span class="text-[10px] text-gray-400 mb-1 font-medium">{{ auth()->user()->name }} (Me) • {{ $msg->created_at->format('h:i a') }}</span>
                                    <div class="bg-[#E8EFFF] text-[#2D3A5D] px-5 py-3 rounded-t-2xl rounded-bl-2xl shadow-sm text-sm border border-blue-50 max-w-lg">
                                        {{ $msg->contenu }}
                                    </div>
                                </div>
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="w-8 h-8 rounded-full mb-1">
                            </div>
                        @else
                            <!-- Other -->
                            <div class="flex justify-start items-end gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}" class="w-8 h-8 rounded-full mb-1">
                                <div class="flex flex-col items-start">
                                    <span class="text-[10px] text-gray-400 mb-1 font-medium">{{ $user->name }} • {{ $msg->created_at->format('h:i a') }}</span>
                                    <div class="bg-[#F3F4F6] text-gray-800 px-5 py-3 rounded-t-2xl rounded-br-2xl shadow-sm text-sm max-w-lg">
                                        {{ $msg->contenu }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="text-center my-4">
                        <span class="text-[11px] bg-gray-100 px-4 py-1 rounded-full text-gray-500 font-bold uppercase tracking-widest">Session Start</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Input Field -->
            <div class="p-6 border-t bg-white shrink-0">
                <form action="{{ route('messages.store', $user) }}" method="POST"
                    class="flex flex-col border border-gray-200 rounded-2xl focus-within:ring-1 focus-within:ring-[#445EF2] transition-all">
                    @csrf
                    <textarea name="contenu" rows="2"
                        class="w-full border-none focus:ring-0 p-4 text-sm text-gray-700 placeholder-gray-400 rounded-t-2xl resize-none"
                        placeholder="Type your message..."></textarea>

                    <div class="flex items-center justify-between p-3 bg-gray-50/50 rounded-b-2xl border-t border-gray-100">
                        <div class="flex gap-4 px-2 text-gray-400">
                            <button type="button" class="hover:text-[#445EF2] transition"><i class="fas fa-bolt"></i></button>
                            <button type="button" class="hover:text-[#445EF2] transition"><i class="far fa-smile"></i></button>
                        </div>
                        <button type="submit"
                            class="bg-[#445EF2] text-white px-6 py-2 rounded-xl font-bold text-sm hover:bg-blue-700 transition flex items-center gap-2 shadow-md">
                            Send <i class="fas fa-paper-plane text-[10px]"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>