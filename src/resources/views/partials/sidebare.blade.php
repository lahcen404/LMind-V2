<aside class="w-64 bg-lmind-navy text-slate-400 border-r border-slate-800 hidden md:flex flex-col z-10 shrink-0">
    <div class="p-6 flex-1 overflow-y-auto custom-scrollbar">
        <nav class="space-y-8">

            @auth
                <!-- SECTION: CORE -->
                <div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4 ml-4">Core Portal</p>
                    <a href="{{ url('/' . strtolower(Auth::user()->role->name) . '/dashboard') }}"
                       class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all {{ Request::is('*/dashboard') ? 'bg-lmind-red-dark text-white shadow-lg' : 'hover:text-white hover:bg-slate-800/50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                </div>

                <!-- SECTION: ADMIN (Management) -->
                @if(Auth::user()->role->name === 'ADMIN')
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4 ml-4">System Management</p>

                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold hover:text-white hover:translate-x-1 transition-all">
                        <span class="w-1.5 h-1.5 rounded-full bg-lmind-red-light"></span>
                        Manage Users
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold hover:text-white hover:translate-x-1 transition-all">
                        <span class="w-1.5 h-1.5 rounded-full bg-lmind-red-light"></span>
                        Manage Classes
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold hover:text-white hover:translate-x-1 transition-all">
                        <span class="w-1.5 h-1.5 rounded-full bg-lmind-red-light"></span>
                        Skill Library
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold hover:text-white hover:translate-x-1 transition-all">
                        <span class="w-1.5 h-1.5 rounded-full bg-lmind-red-light"></span>
                        Sprint Timeline
                    </a>
                </div>
                @endif

                <!-- SECTION: TRAINER (Pedagogy) -->
                @if(Auth::user()->role->name === 'TRAINER')
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4 ml-4">Pedagogical Deck</p>

                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold hover:text-white hover:translate-x-1 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Manage Briefs
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold hover:text-white hover:translate-x-1 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Grade Students
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold hover:text-white hover:translate-x-1 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Evaluation History
                    </a>
                </div>
                @endif

                <!-- SECTION: LEARNER (Student Space) -->
                @if(Auth::user()->role->name === 'LEARNER')
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-4 ml-4">Student Space</p>

                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold hover:text-white hover:translate-x-1 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        My Projects
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold hover:text-white hover:translate-x-1 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        My Evaluations
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-semibold hover:text-white hover:translate-x-1 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Send Livrable
                    </a>
                </div>
                @endif
            @endauth

            @guest
                <div class="text-center p-6 bg-slate-900/50 rounded-3xl border border-slate-800 mx-2">
                    <div class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Locked Area</p>
                    <p class="text-[10px] text-slate-500 mt-2 font-medium">Authentication is required to view the pedagogical menu.</p>
                </div>
            @endguest

        </nav>
    </div>

    <!-- SIDEBAR FOOTER: System Status -->
    <div class="p-6 border-t border-slate-800">
        <div class="bg-slate-900/80 rounded-2xl p-4 border border-slate-800/50">
            <div class="flex items-center justify-between mb-2">
                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">System Engine</p>
                <div class="w-1.5 h-1.5 rounded-full {{ Auth::check() ? 'bg-emerald-500 animate-pulse' : 'bg-amber-500' }}"></div>
            </div>
            <p class="text-[10px] text-slate-300 font-mono tracking-tighter">
            
        </div>
    </div>
</aside>
