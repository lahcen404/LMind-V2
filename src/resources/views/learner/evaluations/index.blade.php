@extends('layouts.app')

@section('title', 'My Technical DNA')

@section('content')
<div class="max-w-7xl mx-auto space-y-12">
    <!-- Header: Mastery Overview -->
    <div class="flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
        <div>
            <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">Pedagogical Achievement</span>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Technical <span class="text-lmind-red-light">DNA</span></h1>
            <p class="text-slate-500 text-sm mt-2 font-medium italic">Consolidated mastery levels across all validated competencies.</p>
        </div>

        <div class="flex items-center gap-4 bg-lmind-navy px-6 py-4 rounded-[2rem] shadow-xl border-b-4 border-lmind-red-mid text-white">
            <div class="text-right">
                <p class="text-[10px] font-black text-rose-400 uppercase tracking-widest">Validated Skills</p>
                <p class="text-xl font-black italic">{{ $skillMastery->count() }} Competencies</p>
            </div>
            <div class="w-12 h-12 bg-slate-800 rounded-2xl flex items-center justify-center text-rose-500 font-black text-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
        </div>
    </div>

    <!-- Section 1: Skill Mastery Matrix (The Radar/Bars) -->
    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm p-10">
        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em] mb-10 italic flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-lmind-red-mid"></span>
            Competency Mastery Levels
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($skillMastery as $mastery)
            <div class="p-6 bg-slate-50 rounded-[2.5rem] border border-slate-100 transition-all hover:bg-white hover:border-lmind-red-light/20 hover:shadow-lg group">
                <div class="flex justify-between items-start mb-6">
                    <span class="text-[10px] font-black bg-lmind-navy text-white px-3 py-1 rounded-lg uppercase tracking-widest italic shadow-md">
                        {{ $mastery->skill->code }}
                    </span>
                    <span class="text-[9px] font-black text-lmind-red-mid uppercase italic tracking-widest">
                        {{ $mastery->achieved_level->value ?? $mastery->achieved_level }}
                    </span>
                </div>

                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight mb-4 min-h-[2.5rem] leading-tight group-hover:text-lmind-red-mid transition-colors">
                    {{ $mastery->skill->name }}
                </h4>

                <!-- Progress Bar Logic -->
                <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden flex">
                    @php
                        $levelVal = match($mastery->achieved_level->value ?? $mastery->achieved_level) {
                            'TRANSPOSER' => 100,
                            'ADAPTER'    => 66,
                            'IMITER'     => 33,
                            default      => 10
                        };
                    @endphp
                    <div class="h-full bg-lmind-red-mid transition-all duration-1000" style="width: {{ $levelVal }}%"></div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-10 text-center text-slate-400 italic font-medium">
                No skills have been evaluated yet. Complete and submit a project to start your DNA mapping.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Section 2: Detailed Project History -->
    <div class="space-y-8">
        <h3 class="text-xs font-black text-slate-800 uppercase tracking-[0.3em] px-4 flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-lmind-navy animate-pulse"></span>
            Evaluation Feed (by Project)
        </h3>

        @foreach($evaluationsByBrief as $briefId => $evals)
        @php $brief = $evals->first()->brief; @endphp
        <div class="bg-lmind-navy rounded-[3.5rem] shadow-2xl p-2 relative overflow-hidden group">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-lmind-red-mid opacity-5 rounded-full blur-3xl group-hover:opacity-10 transition-opacity"></div>

            <div class="bg-white rounded-[3.2rem] overflow-hidden">
                <!-- Brief Header -->
                <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h4 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic">{{ $brief->title }}</h4>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1 italic">Debriefing Period: {{ $evals->first()->created_at->format('M Y') }}</p>
                    </div>
                    <span class="px-4 py-1 bg-lmind-navy text-white text-[9px] font-black rounded-xl uppercase tracking-widest italic">
                        {{ $evals->count() }} Skills Graded
                    </span>
                </div>

                <!-- Skill Breakdown -->
                <div class="p-10 space-y-8">
                    @foreach($evals as $eval)
                    <div class="flex flex-col md:flex-row gap-6 items-start pb-8 border-b border-slate-50 last:border-0">
                        <div class="w-full md:w-48 shrink-0">
                            <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-widest">{{ $eval->skill->code }}</span>
                            <h5 class="text-xs font-black text-slate-800 uppercase leading-tight mt-1">{{ $eval->skill->name }}</h5>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="px-3 py-1 bg-slate-900 text-white text-[9px] font-black rounded uppercase italic tracking-widest">
                                    {{ $eval->achieved_level->value ?? $eval->achieved_level }}
                                </span>
                            </div>
                            <p class="text-xs font-medium text-slate-500 italic leading-relaxed">
                                "{{ $eval->comment ?? 'No specific pedagogical comment provided for this competency.' }}"
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
