@extends('layouts.app')

@section('title', 'My Skill Roadmap')

@section('content')
<!-- Header: Welcome & Global Mastery -->
<div class="mb-10 flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
    <div>
        <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">Student Workspace</span>
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">My <span class="text-lmind-red-light">Skill</span> Progress</h1>
    </div>

    <div class="flex items-center gap-4 bg-white p-3 pr-8 rounded-[2rem] shadow-sm border border-slate-100">
        <div class="w-14 h-14 bg-lmind-navy rounded-2xl flex items-center justify-center text-white font-black text-lg shadow-lg border-b-4 border-lmind-red-mid">
            72%
        </div>
        <div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Global Mastery</p>
            <p class="text-xs font-bold text-slate-800 uppercase tracking-tight">S_Adapter Phase</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

    <!-- Left Column: Competency Roadmap (8/12) -->
    <div class="lg:col-span-8 space-y-6">
        <div class="flex items-center justify-between mb-2 px-2">
            <h2 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em]">Competency Matrix</h2>
            <span class="text-[10px] font-bold text-slate-400 uppercase">Last updated: Just now</span>
        </div>

        {{-- Static Skill Data for UI Preview --}}
        @php
            $competencies = [
                ['id' => 'C1', 'title' => 'Maquetter une application', 'progress' => 85, 'level' => 'TRANSPOSER', 'color' => 'bg-emerald-500'],
                ['id' => 'C2', 'title' => 'Réaliser une interface statique', 'progress' => 65, 'level' => 'ADAPTER', 'color' => 'bg-amber-500'],
                ['id' => 'C3', 'title' => 'Développer une interface dynamique', 'progress' => 30, 'level' => 'IMITER', 'color' => 'bg-rose-500'],
                ['id' => 'C4', 'title' => 'Réaliser une base de données', 'progress' => 50, 'level' => 'ADAPTER', 'color' => 'bg-blue-500'],
            ];
        @endphp

        @foreach($competencies as $skill)
        <div class="bg-white p-8 rounded-[2.5rem] border-b-4 border-slate-200 hover:border-lmind-red-light transition-all shadow-sm group">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center font-black text-xs group-hover:bg-lmind-red-mid transition-colors shadow-inner">
                        {{ $skill['id'] }}
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-800 tracking-tight leading-none">{{ $skill['title'] }}</h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Fullstack Developer Program</p>
                    </div>
                </div>
                <span class="inline-block px-4 py-1.5 rounded-full bg-rose-50 text-lmind-red-dark text-[10px] font-black uppercase tracking-widest border border-rose-100">
                    {{ $skill['level'] }}
                </span>
            </div>

            <!-- Custom Progress Bar -->
            <div class="relative h-3 w-full bg-slate-100 rounded-full overflow-hidden">
                <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-lmind-red-mid to-lmind-red-light rounded-full shadow-lg transition-all duration-1000"
                     style="width: {{ $skill['progress'] }}%">
                </div>
            </div>

            <div class="mt-4 flex justify-between items-center">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Achieved level: {{ $skill['progress'] }}%</p>
                <a href="#" class="text-[10px] font-black text-lmind-navy hover:text-lmind-red-light uppercase tracking-widest transition-colors flex items-center gap-1">
                    History
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="3"/></svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Right Column: Stats & Submissions (4/12) -->
    <div class="lg:col-span-4 space-y-8">

        <!-- Submission Status Card -->
        <div class="bg-lmind-navy p-8 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-lmind-red-mid opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity"></div>

            <h4 class="text-[10px] font-black text-rose-400 uppercase tracking-[0.3em] mb-8">Personal Stats</h4>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/5 border border-white/10 p-5 rounded-3xl">
                    <span class="text-3xl font-black italic">12</span>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mt-1">Briefs Done</p>
                </div>
                <div class="bg-white/5 border border-white/10 p-5 rounded-3xl">
                    <span class="text-3xl font-black italic">04</span>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mt-1">Sprints Left</p>
                </div>
            </div>

            <a href="#" class="mt-8 block w-full bg-lmind-red-mid hover:bg-lmind-red-light py-4 rounded-2xl text-center text-xs font-black uppercase tracking-widest transition-all active:scale-95 shadow-xl shadow-rose-900/40">
                Send New Livrable
            </a>
        </div>

        <!-- Active Brief Context -->
        <div class="bg-white p-8 rounded-[3rem] border border-slate-200 shadow-sm">
            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Current Focus</h4>

            <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 mb-6">
                <p class="text-base font-black text-slate-800 tracking-tight leading-tight uppercase">Portfolio Pro v2.0</p>
                <div class="flex items-center gap-2 mt-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Active Project</span>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between text-[10px] font-black uppercase tracking-widest">
                    <span class="text-slate-400">Time Progress</span>
                    <span class="text-lmind-red-mid">75%</span>
                </div>
                <div class="h-1.5 w-full bg-slate-100 rounded-full">
                    <div class="h-full bg-lmind-navy w-3/4 rounded-full"></div>
                </div>
            </div>

            <a href="#" class="block w-full text-center mt-8 text-[10px] font-black text-slate-400 hover:text-lmind-red-mid uppercase tracking-[0.3em] transition">
                Access Brief Resources
            </a>
        </div>

        <!-- Latest Trainer Feedback -->
        <div class="p-2">
            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 px-2">Trainer's Note</h4>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="flex gap-4 items-start">
                    <div class="w-8 h-8 rounded-full bg-lmind-red-mid shrink-0 flex items-center justify-center text-white font-black text-[10px] uppercase shadow-lg">S</div>
                    <p class="text-xs leading-relaxed italic text-slate-500">
                        "Your logic in the database migration is very solid. Try to improve the UI finish on the login page."
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
