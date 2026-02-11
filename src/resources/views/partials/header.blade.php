<nav class="bg-indigo-700 text-white p-4 shadow-md flex justify-between items-center">
    <div class="font-bold text-xl tracking-tight">LMind</div>
    <div class="flex items-center gap-6">
        @auth
        <div class="text-sm">
            <span class="opacity-75">Logged in as:</span>
            <span class="font-semibold">{{ Auth::user()->full_name }}</span>
            <span class="bg-indigo-800 px-2 py-1 rounded text-xs ml-2">{{ Auth::user()->role->name }}</span>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm transition">Logout</button>
        </form>
        @endauth
        @guest
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded text-sm transition">Login</a>
        @endguest

    </div>
</nav>

