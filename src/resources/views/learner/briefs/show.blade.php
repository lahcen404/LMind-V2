@extends('layouts.app')

@section('title', $brief->title)

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header: Navigation & Context -->
    <div class="mb-10 flex flex-col md:flex-row justify-between items-start gap-6">
        <div class="flex-1">
            <a href="{{ route('learner.dashboard') }}" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition flex items-center gap-2 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                Back to Roadmap
            </a>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic leading-none">{{ $brief->title }}</h1>
            <div class="flex items-center gap-6 mt-4">
                <span class="px-4 py-1.5 bg-lmind-navy text-white text-[9px] font-black rounded-xl uppercase italic tracking-widest shadow-sm">
                    {{ $brief->type->name ?? $brief->type }}
                </span>
                <div class="flex items-center gap-2 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-[10px] font-black uppercase tracking-widest italic">Duration: {{ $brief->duration }} Weeks</span>
                </div>
                <div class="flex items-center gap-2 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-[10px] font-black uppercase tracking-widest italic">{{ $brief->sprint->name ?? 'Continuous Sprint' }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-2xl bg-lmind-red-mid text-white flex items-center justify-center font-black text-xl italic shadow-lg group-hover:rotate-12 transition-transform">
                {{ substr($brief->trainer->user->full_name ?? 'T', 0, 1) }}
            </div>
            <div>
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Project Lead</p>
                <p class="text-sm font-bold text-slate-800 italic">{{ $brief->trainer->user->full_name ?? 'Pedagogical Team' }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

        <!-- LEFT: Briefing Content & Submission -->
        <div class="lg:col-span-8 space-y-10">

            <!-- Technical Instructions -->
            <div class="bg-white p-10 rounded-[3.5rem] border-b-8 border-slate-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-lmind-red-mid"></div>
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-10 italic">Technical Context & Objectives</h3>

                <div class="prose prose-slate max-w-none">
                    <p class="font-medium text-slate-600 leading-relaxed italic whitespace-pre-line text-lg">
                        {{ $brief->description }}
                    </p>
                </div>
            </div>

            <!-- Submission Gateway -->
            <div class="bg-lmind-navy p-12 rounded-[4rem] shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-lmind-red-mid opacity-5 rounded-full blur-3xl group-hover:opacity-10 transition-opacity"></div>

                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-10 bg-lmind-red-mid rounded-xl flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    </div>
                    <h3 class="text-[11px] font-black text-rose-400 uppercase tracking-[0.4em] italic">Livrable Deployment Portal</h3>
                </div>

                <form action="{{ route('learner.briefs.submit', $brief->id) }}" method="POST" class="space-y-8">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4 ml-1 text-white/40 italic">GitHub Repository / Production URL</label>
                        <input type="url" name="url" value="{{ old('url', $submission->url ?? '') }}" required
                               placeholder="https://github.com/your-username/project-repository"
                               class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-[2rem] px-8 py-5 text-white font-bold focus:border-lmind-red-light focus:outline-none transition-all italic text-sm placeholder:text-slate-700">
                        @error('url') <p class="text-rose-500 text-[10px] font-black mt-3 uppercase italic ml-2 tracking-widest">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-white text-lmind-navy py-6 rounded-[2rem] font-black uppercase tracking-[0.3em] text-xs hover:bg-lmind-red-mid hover:text-white transition-all active:scale-95 shadow-2xl shadow-black/20">
                        {{ isset($submission) ? 'Sync Updated Livrable' : 'Deploy Submission' }}
                    </button>
                </form>

                @if(isset($submission))
                <div class="mt-10 p-6 bg-emerald-500/5 border border-emerald-500/20 rounded-[2.5rem] flex items-center justify-between group/link">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest italic">Submission Active</p>
                    </div>
                    <a href="{{ $submission->url }}" target="_blank" class="text-[10px] font-black text-white underline underline-offset-4 uppercase tracking-widest hover:text-emerald-400 transition-colors">
                        Inspect Link
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- RIGHT: Skill Matrix (Pedagogical DNA) -->
        <div class="lg:col-span-4 space-y-8">
            <div class="bg-white p-8 rounded-[3.5rem] border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 mb-10 border-l-4 border-lmind-red-light pl-4">
                    <h3 class="text-[10px] font-black text-slate-800 uppercase tracking-[0.3em] italic leading-none">Targeted Skills</h3>
                </div>

                <div class="space-y-6">
                    @forelse($brief->skills as $skill)
                    <div class="p-6 bg-slate-50 rounded-[2.5rem] border border-slate-100 transition-all hover:bg-white hover:border-lmind-red-light/20 shadow-sm relative group/skill">
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-[10px] font-black bg-lmind-navy text-white px-3 py-1 rounded-lg uppercase italic tracking-widest shadow-md">
                                {{ $skill->code }}
                            </span>
                            <div class="text-right">
                                <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Target Mastery</p>
                                <span class="text-[9px] font-black text-lmind-red-mid uppercase tracking-widest italic">
                                    {{ $skill->pivot->expected_level }}
                                </span>
                            </div>
                        </div>
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-tight leading-tight italic">{{ $skill->name }}</h4>
                    </div>
                    @empty
                    <div class="py-10 text-center text-slate-300 italic text-[10px] font-black uppercase tracking-widest">
                        No specific skills mapped.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Support & Feedback Notice -->
            <div class="bg-slate-50 p-8 rounded-[3rem] border border-dashed border-slate-200">
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-slate-900 text-white rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                        <span class="text-slate-900">Pro-Tip:</span> Once your work is deployed, the trainer will be notified for debriefing. You can update your link at any time before the final evaluation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
