@extends('layouts.app')

@section('title', 'Trainer Dashboard')

@section('content')
<!-- Page Header -->
<div class="mb-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
    <div>
        <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">Pedagogical Deck</span>
        <h1 class="text-4xl font-black text-slate-900 tracking-tight">Active <span class="text-lmind-red-light">Promotion</span></h1>
    </div>

    <!-- Class Info Card -->
    <div class="bg-lmind-navy text-white px-6 py-4 rounded-[2rem] flex items-center gap-4 shadow-xl border-b-4 border-lmind-red-mid">
        <div class="text-right">
            <p class="text-[10px] font-black text-rose-400 uppercase tracking-widest">Current Class</p>
            <p class="font-bold tracking-tight">Web Fullstack 2026</p>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-lmind-red-dark flex items-center justify-center font-black text-xl shadow-inner">W</div>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

    <!-- Left Column: Learner Tracking -->
    <div class="xl:col-span-2 space-y-8">
        <div class="bg-white rounded-[2.5rem] border-b-8 border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
                <h2 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Learner Progress Tracking</h2>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase tracking-widest">18 Active</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] uppercase font-black text-slate-400 bg-slate-50/20 border-b border-slate-50">
                            <th class="px-8 py-5">Learner Profile</th>
                            <th class="px-8 py-5 text-center">Submissions</th>
                            <th class="px-8 py-5 text-center">Avg. Mastery</th>
                            <th class="px-8 py-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        {{-- Static Placeholder Data --}}
                        @php
                            $mockLearners = [
                                ['name' => 'Alex Rivera', 'email' => 'alex.r@lmind.com', 'subs' => 4, 'level' => '2.4'],
                                ['name' => 'Jordan Smith', 'email' => 'jordan.s@lmind.com', 'subs' => 3, 'level' => '1.8'],
                                ['name' => 'Maria Garcia', 'email' => 'm.garcia@lmind.com', 'subs' => 5, 'level' => '2.9'],
                            ];
                        @endphp

                        @foreach($mockLearners as $learner)
                        <tr class="group hover:bg-rose-50/30 transition-colors">
                            <td class="px-8 py-6">
                                <p class="font-black text-slate-800 uppercase tracking-tight">{{ $learner['name'] }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest italic">{{ $learner['email'] }}</p>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="px-3 py-1 bg-lmind-navy text-white rounded-lg text-[10px] font-black uppercase tracking-tighter shadow-sm">
                                    {{ $learner['subs'] }} Submit
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="font-black text-lmind-red-mid text-sm">Level {{ $learner['level'] }}</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="bg-lmind-red-mid text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-lmind-red-dark transition shadow-lg shadow-rose-900/10 active:scale-95">
                                    Evaluate
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-6 bg-slate-50 border-t border-slate-100 text-center">
                <a href="#" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] hover:text-lmind-red-mid transition">View All Students in Promotion</a>
            </div>
        </div>
    </div>

    <!-- Right Column: Context & Timeline -->
    <div class="space-y-8">

        <!-- Current Brief Highlight -->
        <div class="bg-lmind-red-dark text-white p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white opacity-5 rounded-full group-hover:scale-150 transition-transform duration-1000"></div>

            <div class="relative z-10">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] mb-6 block text-rose-300">Active Brief / Project</span>
                <h2 class="text-2xl font-black mb-2 italic tracking-tight">Portfolio Pro v2</h2>
                <p class="text-sm text-rose-100 font-medium leading-relaxed opacity-80 mb-8">Implementing a full Laravel architecture with advanced Blade templating and Tailwind CSS.</p>

                <div class="flex flex-wrap gap-2 mb-8">
                    <span class="bg-lmind-red-mid/40 border border-white/20 px-3 py-1 rounded-full text-[10px] font-black uppercase">#Laravel_11</span>
                    <span class="bg-lmind-red-mid/40 border border-white/20 px-3 py-1 rounded-full text-[10px] font-black uppercase">#Backend</span>
                </div>

                <button class="w-full bg-white text-lmind-red-dark py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-rose-50 transition-colors">
                    Manage Project
                </button>
            </div>
        </div>

        <!-- Sprint Timeline -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm">
            <h3 class="text-lg font-black text-slate-800 mb-8 uppercase tracking-tighter">Class Timeline</h3>
            <div class="space-y-8 relative">
                <!-- Vertical Line -->
                <div class="absolute left-6 top-2 bottom-2 w-0.5 bg-slate-100"></div>

                <div class="flex items-center gap-6 relative">
                    <div class="w-12 h-12 rounded-2xl bg-lmind-red-light text-white flex items-center justify-center font-black shadow-lg shadow-rose-500/30 z-10">1</div>
                    <div>
                        <p class="text-sm font-black text-slate-800">HTML/CSS Fundamentals</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Completed</p>
                    </div>
                </div>

                <div class="flex items-center gap-6 relative">
                    <div class="w-12 h-12 rounded-2xl bg-lmind-navy text-white flex items-center justify-center font-black z-10">2</div>
                    <div>
                        <p class="text-sm font-black text-slate-800">Advanced PHP & DB</p>
                        <p class="text-[10px] font-bold text-emerald-500 uppercase flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Current Sprint
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-6 relative">
                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-300 flex items-center justify-center font-black z-10">3</div>
                    <div>
                        <p class="text-sm font-black text-slate-400">Framework Mastery</p>
                        <p class="text-[10px] font-bold text-slate-300 uppercase">Upcoming</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
