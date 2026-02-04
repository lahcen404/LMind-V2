<aside class="w-64 bg-lmind-navy text-slate-400 border-r border-slate-800 hidden md:flex flex-col z-10">
    <div class="p-6 flex-1">
        <nav class="space-y-8">

            {{-- 1. Only show the Dashboard link if the user is actually logged in --}}
            @auth
                <div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4">Core</p>
                    <a href="{{ url('/' . strtolower(Auth::user()->role->name) . '/dashboard') }}"
                       class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl {{ Request::is('*/dashboard') ? 'bg-lmind-red-dark text-white shadow-inner' : 'hover:text-white transition' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                </div>

                {{-- 2. Admin Logic with safety check --}}
                @if(Auth::user()->role->name === 'ADMIN')
                <div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4">Management</p>
                    <div class="space-y-1">
                        <a href="#" class="block px-4 py-2 text-sm font-semibold hover:text-white transition">Users</a>
                        <a href="#" class="block px-4 py-2 text-sm font-semibold hover:text-white transition">Classes</a>
                    </div>
                </div>
                @endif

                {{-- 3. Trainer Logic with safety check --}}
                @if(Auth::user()->role->name === 'TRAINER')
                <div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4">Academic</p>
                    <div class="space-y-1">
                        <a href="#" class="block px-4 py-2 text-sm font-semibold hover:text-white transition">Projects</a>
                        <a href="#" class="block px-4 py-2 text-sm font-semibold hover:text-white transition">Grade Students</a>
                    </div>
                </div>
                @endif
            @endauth

            {{-- 4. What guests see (Login Page) --}}
            @guest
                <div class="text-center p-4 bg-slate-900/50 rounded-2xl border border-slate-800">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Authentication Required</p>
                    <p class="text-xs text-slate-400 mt-2">Please sign in to view the navigation menu.</p>
                </div>
            @endguest

        </nav>
    </div>

    <div class="p-6 border-t border-slate-800">
        <div class="bg-slate-900 rounded-xl p-4 border border-slate-800">
            <p class="text-[10px] font-bold text-slate-500 uppercase">System Status</p>
            <div class="flex items-center gap-2 mt-1">
                <div class="w-2 h-2 rounded-full bg-green-500 {{ Auth::check() ? 'animate-pulse' : '' }}"></div>
                <p class="text-xs text-slate-300 font-mono">{{ Auth::check() ? 'ONLINE' : 'SECURE_MODE' }}</p>
            </div>
        </div>
    </div>
</aside>
