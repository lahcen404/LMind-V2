@extends('layouts.app')

@section('title', 'My Roadmap')

@section('content')
<!-- Header: Welcome & Stats -->
<div class="mb-10 flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
    <div>
        <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">Student Workspace</span>
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Project <span class="text-lmind-red-light">Roadmap</span></h1>
        <p class="text-slate-500 text-sm mt-2 font-medium">Class:
            <span class="text-slate-900 font-bold underline decoration-lmind-red-light underline-offset-4">
                {{ Auth::user()->learner->trainingClass->name ?? 'Awaiting Assignment' }}
            </span>
        </p>
    </div>

    <!-- KPI Stats Section -->
    <div class="flex gap-4">
        <div class="flex items-center gap-4 bg-white p-3 pr-8 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="w-12 h-12 bg-lmind-navy rounded-2xl flex items-center justify-center text-white font-black text-lg shadow-lg border-b-4 border-emerald-500">
                {{ $stats['done'] }}
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Completed</p>
                <p class="text-xs font-bold text-slate-800 uppercase tracking-tight italic">Briefs</p>
            </div>
        </div>

        <div class="flex items-center gap-4 bg-white p-3 pr-8 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="w-12 h-12 bg-lmind-navy rounded-2xl flex items-center justify-center text-white font-black text-lg shadow-lg border-b-4 border-rose-500">
                {{ $stats['pending'] }}
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Pending</p>
                <p class="text-xs font-bold text-slate-800 uppercase tracking-tight italic">Submissions</p>
            </div>
        </div>
    </div>
</div>

<!-- Briefs Roadmap Grid -->
<div class="space-y-8">
    <div class="flex items-center gap-4 px-2">
        <h2 class="text-xs font-black text-slate-800 uppercase tracking-[0.3em] flex items-center gap-2">
            <span class="w-2 h-2 bg-lmind-red-mid rounded-full animate-pulse"></span>
            Active Pedagogical Briefs
        </h2>
        <div class="flex-1 h-px bg-slate-200"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @forelse($briefs as $brief)
            @php $isSubmitted = in_array($brief->id, $submissions); @endphp

            <div class="bg-white rounded-[3rem] border-b-8 {{ $isSubmitted ? 'border-emerald-500' : 'border-slate-200 hover:border-lmind-red-light' }} p-8 transition-all group shadow-sm flex flex-col relative overflow-hidden h-full">

                <!-- Status & Type Header -->
                <div class="flex justify-between items-start mb-6">
                    <span class="px-3 py-1 {{ $isSubmitted ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-slate-50 text-slate-500 border-slate-100' }} border text-[9px] font-black rounded-lg uppercase italic tracking-widest">
                        {{ $isSubmitted ? 'Livrable Submitted' : 'Submission Required' }}
                    </span>
                    <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest italic">
                        {{ $brief->type->name ?? $brief->type }}
                    </span>
                </div>

                <!-- Brief Content -->
                <div class="mb-8">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter mb-2 group-hover:text-lmind-red-mid transition-colors italic leading-tight">
                        {{ $brief->title }}
                    </h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">
                        {{ $brief->duration }} Weeks • {{ $brief->sprint->name ?? 'Open Timeline' }}
                    </p>

                    <!-- Skill Mapping Tags -->
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($brief->skills as $skill)
                            <span class="px-2 py-1 bg-slate-900 text-white text-[8px] font-black rounded uppercase italic tracking-tighter shadow-sm">
                                {{ $skill->code }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Footer Action -->
                <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-lmind-red-mid text-white flex items-center justify-center text-[10px] font-black italic shadow-md">
                            {{ substr($brief->trainer->user->full_name ?? 'T', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest leading-none">Trainer</p>
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-tight italic">{{ $brief->trainer->user->full_name ?? 'Lead' }}</p>
                        </div>
                    </div>

                    <a href="{{ route('learner.briefs.show', $brief->id) }}"
                       class="bg-lmind-navy text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-lmind-red-mid transition-all shadow-xl shadow-slate-900/10 active:scale-95">
                        {{ $isSubmitted ? 'View Submission' : 'Open Brief' }}
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-24 text-center bg-white rounded-[4rem] border-2 border-dashed border-slate-200">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h4 class="text-xl font-black text-slate-400 uppercase tracking-tighter">No Active Briefs</h4>
                <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mt-2 opacity-60 italic">Your pedagogical roadmap is currently clear. Contact your trainer for deployments.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
