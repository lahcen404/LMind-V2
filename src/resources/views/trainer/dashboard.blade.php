@extends('layouts.app')

@section('title', 'Trainer Dashboard')

@section('content')
@if(!$currentClass)
    <div class="py-20 text-center bg-white rounded-[4rem] border-2 border-dashed border-slate-200">
        <h2 class="text-2xl font-black text-slate-400 uppercase italic">No Active Promotion</h2>
        <p class="text-slate-400 mt-2 font-bold uppercase tracking-widest text-[10px]">You are not currently assigned as a trainer to any class.</p>
    </div>
@else
    <!-- Page Header & Class Context Switcher -->
    <div class="mb-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
        <div>
            <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block tracking-widest">Pedagogical Deck</span>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-none uppercase italic">Class <span class="text-lmind-red-light">Management</span></h1>
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <!-- PROMOTION SWITCHER -->
            <form action="{{ route('trainer.dashboard') }}" method="GET" class="flex items-center gap-3 bg-white p-2 pl-6 rounded-3xl border border-slate-100 shadow-sm transition-all hover:shadow-md">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Switch Promotion:</span>
                <select name="class_id" onchange="this.form.submit()" class="bg-transparent border-none text-xs font-black uppercase text-lmind-navy focus:ring-0 cursor-pointer pr-8">
                    @foreach($allClasses as $class)
                        <option value="{{ $class->id }}" {{ $currentClass->id == $class->id ? 'selected' : '' }}>
                            {{ $class->name }} ({{ $class->promotion }})
                        </option>
                    @endforeach
                </select>
            </form>

            <div class="bg-lmind-navy text-white px-6 py-4 rounded-3xl flex items-center gap-4 shadow-xl border-b-4 border-lmind-red-mid">
                <div class="w-10 h-10 rounded-2xl bg-lmind-red-dark flex items-center justify-center font-black text-lg italic shadow-inner">
                    {{ substr($currentClass->name, 0, 1) }}
                </div>
                <div class="hidden sm:block">
                    <p class="text-[9px] font-black text-rose-400 uppercase tracking-widest leading-none mb-1">Active View</p>
                    <p class="text-xs font-bold uppercase italic">{{ $currentClass->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">

        <!-- LEFT COLUMN: Roster & Evaluation Logic (8/12) -->
        <div class="xl:col-span-8 space-y-8">
            <div class="bg-white rounded-[3rem] border-b-8 border-slate-200 shadow-sm overflow-hidden transition-all">

                <!-- Table Header with Project Switcher -->
                <div class="p-8 border-b border-slate-50 bg-slate-50/30 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h2 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic">Evaluation Roster</h2>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">
                            Tracking: <span class="text-lmind-red-mid font-black">{{ $activeBrief->title ?? 'None Deployed' }}</span>
                        </p>
                    </div>

                    <!-- BRIEF CONTEXT SWITCHER -->
                    @if($briefs->count() > 0)
                    <form action="{{ route('trainer.dashboard') }}" method="GET" class="flex items-center gap-3">
                        <input type="hidden" name="class_id" value="{{ $currentClass->id }}">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest hidden md:block">Active Brief:</label>
                        <select name="brief_id" onchange="this.form.submit()" class="bg-slate-900 text-white text-[10px] font-black uppercase px-5 py-2.5 rounded-xl focus:ring-lmind-red-light transition-all cursor-pointer shadow-lg border-none">
                            @foreach($briefs as $brief)
                                <option value="{{ $brief->id }}" {{ ($activeBrief && $activeBrief->id == $brief->id) ? 'selected' : '' }}>
                                    {{ $brief->title }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    @endif
                </div>

                <!-- Learner Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] uppercase font-black text-slate-400 bg-slate-50/20 border-b border-slate-50">
                                <th class="px-10 py-5">Learner Profile</th>
                                <th class="px-10 py-5 text-center">Project Status</th>
                                <th class="px-10 py-5 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($learners as $learner)
                            <tr class="group hover:bg-rose-50/30 transition-colors">
                                <td class="px-10 py-7">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center font-black text-xs group-hover:bg-white transition-colors">
                                            {{ substr($learner->user->full_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-slate-800 uppercase tracking-tight">{{ $learner->user->full_name }}</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest italic">{{ $learner->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-7 text-center">
                                    @if($activeBrief)
                                        @php $submission = $learner->livrables->first(); @endphp
                                        @if($submission)
                                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-emerald-100 shadow-sm flex items-center justify-center gap-2 mx-auto w-fit italic">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Livrable Ready
                                            </span>
                                        @else
                                            <span class="px-4 py-1.5 bg-slate-100 text-slate-400 rounded-full text-[9px] font-black uppercase tracking-widest border border-slate-200 inline-block italic">
                                                Awaiting Sync
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-[9px] text-slate-300 uppercase font-black italic">--</span>
                                    @endif
                                </td>
                                <td class="px-10 py-7 text-right">
                                    @if($activeBrief && isset($submission))
                                        <a href="{{ route('trainer.evaluations.create', [$activeBrief->id, $learner->id]) }}"
                                           class="bg-lmind-navy text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-lmind-red-mid transition shadow-lg active:scale-95 inline-flex items-center gap-2">
                                            Assess Skills
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-10 py-16 text-center text-slate-400 italic font-medium">No learners assigned to this promotion yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6 bg-slate-50 border-t border-slate-100 text-center">
                    <a href="{{ route('trainer.classes.assign', $currentClass->id) }}" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] hover:text-lmind-red-mid transition-all">
                        Update Promotion Roster
                    </a>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Timeline & Context Card (4/12) -->
        <div class="xl:col-span-4 space-y-8">

            <!-- Contextual Project Card -->
            <div class="bg-lmind-red-dark text-white p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group">
                <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-white opacity-5 rounded-full group-hover:scale-150 transition-transform duration-1000"></div>

                <div class="relative z-10">
                    <span class="text-[9px] font-black uppercase tracking-[0.4em] mb-6 block text-rose-300 italic">Project Identity</span>

                    @if($activeBrief)
                        <h2 class="text-3xl font-black mb-4 italic tracking-tighter uppercase leading-none">{{ $activeBrief->title }}</h2>
                        <div class="flex flex-wrap gap-2 mb-10">
                            @foreach($activeBrief->skills as $skill)
                                <span class="bg-white/10 border border-white/20 px-3 py-1 rounded-lg text-[9px] font-black uppercase italic">
                                    {{ $skill->code }}
                                </span>
                            @endforeach
                        </div>
                        <div class="space-y-3">
                            <a href="{{ route('trainer.briefs.edit', $activeBrief->id) }}" class="w-full bg-white text-lmind-red-dark py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-rose-50 transition-all text-center block shadow-xl active:scale-95">
                                Edit Requirements
                            </a>
                        </div>
                    @else
                        <p class="text-sm font-bold text-rose-200 italic mb-10">Your pedagogical library is empty for this class.</p>
                        <a href="{{ route('trainer.briefs.create', ['class_id' => $currentClass->id]) }}" class="w-full bg-white text-lmind-red-dark py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-rose-50 transition-colors text-center block">
                            Deploy New Brief
                        </a>
                    @endif
                </div>
            </div>

            <!-- Promotion Timeline (Sprints) -->
            <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm relative overflow-hidden">
                <h3 class="text-xs font-black text-slate-800 mb-10 uppercase tracking-[0.3em] border-l-4 border-lmind-red-mid pl-4 italic leading-none">Class Roadmap</h3>

                <div class="space-y-10 relative">
                    <!-- Vertical Track -->
                    <div class="absolute left-6 top-2 bottom-2 w-0.5 bg-slate-100"></div>

                    @forelse($sprints as $index => $sprint)
                    <div class="flex items-center gap-6 relative group/sprint">
                        <div class="w-12 h-12 rounded-2xl {{ $index === 0 ? 'bg-lmind-red-light shadow-rose-500/20' : 'bg-lmind-navy' }} text-white flex items-center justify-center font-black shadow-lg z-10 italic text-sm group-hover/sprint:scale-110 transition-transform">
                            {{ $sprint->order_sprint }}
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-800 uppercase tracking-tight leading-tight italic">{{ $sprint->name }}</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase italic tracking-[0.2em] mt-1">{{ $sprint->duration }} Weeks Block</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-6">
                        <p class="text-[10px] text-slate-300 italic uppercase font-black tracking-widest">Chronology undefined</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endif
@endsection
