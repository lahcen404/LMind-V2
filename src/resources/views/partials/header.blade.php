<header class="bg-lmind-navy text-white border-b border-slate-800 z-30 sticky top-0 italic">
    <div class="px-6 py-4 flex justify-between items-center max-w-[1920px] mx-auto">

        <!-- LOGO AREA: Branding with Generated Asset -->
        @php
            // Safe URL generation: Fallback to home if not logged in
            $brandingUrl = Auth::check()
                ? route(match(Auth::user()->role->name) {
                    'ADMIN'   => 'admin.dashboard',
                    'TRAINER' => 'trainer.dashboard',
                    'LEARNER' => 'learner.dashboard',
                    default   => 'login'
                })
                : url('/');
        @endphp

        <a href="{{ $brandingUrl }}" class="flex items-center gap-4 group cursor-pointer">
            <div class="relative">
                <!-- LOGO IMAGE: Fixed path using asset helper -->
                <div class="w-12 h-12 rounded-xl overflow-hidden shadow-lg shadow-rose-900/20 group-hover:rotate-6 transition-transform duration-300 border-2 border-slate-800 bg-white/5 p-1">
                    <img src="{{ asset('lmind-logo-removebg-preview.png') }}"
                         alt="LMind Logo"
                         class="w-full h-full object-contain"
                         onerror="this.src='https://ui-avatars.com/api/?name=L&color=FFFFFF&background=be123c&bold=true'">
                </div>
                <!-- Status indicator (Only show if authenticated) -->
                @auth
                <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 border-2 border-lmind-navy rounded-full shadow-sm"></div>
                @endauth
            </div>

            <div class="flex flex-col">
                <span class="text-2xl font-black tracking-tighter uppercase leading-none text-white">
                    LMind <span class="text-lmind-red-light">System</span>
                </span>
                <span class="text-[9px] font-black text-slate-500 uppercase tracking-[0.3em] leading-none mt-1.5">
                    Pedagogical Engine v2.0
                </span>
            </div>
        </a>

        <!-- USER CONTROL AREA -->
        <div class="flex items-center gap-8">

            @auth
                <!-- User Meta & Deck Identity -->
                <div class="flex items-center gap-5 border-r border-slate-800 pr-8">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-black text-white uppercase tracking-tight leading-none mb-1.5">
                            {{ Auth::user()->full_name }}
                        </p>

                        @php
                            $roleColor = match(Auth::user()->role->name) {
                                'ADMIN' => 'text-amber-400 bg-amber-400/10 border-amber-400/20',
                                'TRAINER' => 'text-lmind-red-light bg-rose-50/10 border-rose-50/20',
                                'LEARNER' => 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20',
                                default => 'text-slate-400 bg-slate-500/10 border-slate-500/20'
                            };
                        @endphp

                        <span class="px-2.5 py-0.5 rounded-md text-[8px] font-black uppercase tracking-widest border {{ $roleColor }}">
                            {{ Auth::user()->role->name }} DECK
                        </span>
                    </div>

                    <!-- Profile Avatar -->
                    <div class="h-12 w-12 rounded-2xl bg-slate-800 border-2 border-slate-700 p-0.5 shadow-inner group hover:border-lmind-red-mid transition-colors cursor-pointer">
                        <div class="h-full w-full rounded-[0.9rem] bg-lmind-navy-light flex items-center justify-center text-lmind-red-light font-black text-sm uppercase italic">
                            {{ substr(Auth::user()->full_name, 0, 1) }}
                        </div>
                    </div>
                </div>

                <!-- Global Actions -->
                <div class="flex items-center gap-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-3 text-slate-500 hover:text-lmind-red-light hover:bg-slate-800/50 rounded-xl transition-all group flex items-center gap-2 active:scale-95" title="Terminate Secure Session">
                            <span class="text-[10px] font-black uppercase tracking-widest hidden lg:block">Logout</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="bg-lmind-red-mid hover:bg-lmind-red-light text-white px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-rose-900/20 transition-all active:scale-95 flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    System Entry
                </a>
            @endguest

        </div>
    </div>
</header>
