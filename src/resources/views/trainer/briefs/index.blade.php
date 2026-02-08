@extends('layouts.app')

@section('title', 'Project Briefs')

@section('content')
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
    <div>
        <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">Pedagogical Deck</span>
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Project <span class="text-lmind-red-light">Briefs</span></h1>
    </div>

    <a href="{{ route('trainer.briefs.create') }}" class="bg-lmind-navy text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-lmind-red-mid transition-all shadow-xl shadow-slate-900/10 active:scale-95 flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
        Create New Brief
    </a>
</div>

<!-- Briefs Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    @forelse($briefs as $brief)
    <div class="bg-white rounded-[3rem] border-b-8 border-slate-200 p-10 hover:border-lmind-red-light transition-all group shadow-sm flex flex-col relative overflow-hidden">

        <!-- Sprint Tag -->
        <div class="flex justify-between items-start mb-6">
            <div class="px-4 py-1.5 bg-slate-900 text-white rounded-xl text-[9px] font-black uppercase tracking-widest italic shadow-lg">
                {{ $brief->sprint->name ?? 'Timeline Unit' }}
            </div>

            <!-- Context Menu -->
            <div class="flex items-center gap-2">
                <a href="{{ route('trainer.briefs.edit', $brief->id) }}" class="p-2 text-slate-300 hover:text-lmind-navy transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </a>
            </div>
        </div>

        <!-- Brief Identity -->
        <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tighter mb-4 leading-none group-hover:text-lmind-red-mid transition-colors italic">
            {{ $brief->title }}
        </h3>

        <p class="text-sm text-slate-500 font-medium leading-relaxed mb-10 line-clamp-3 italic">
            "{{ $brief->description }}"
        </p>

        <!-- Skill Mapping Section -->
        <div class="mt-auto">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 border-l-2 border-lmind-red-light pl-3">Targeted Competencies</p>
            <div class="flex flex-wrap gap-2 mb-10 min-h-[40px]">
                @foreach($brief->skills as $skill)
                <div class="flex items-center bg-slate-50 border border-slate-100 rounded-lg overflow-hidden shadow-sm">
                    <span class="px-3 py-1 bg-lmind-navy text-white text-[9px] font-black">{{ $skill->code }}</span>
                    <span class="px-3 py-1 text-[9px] font-black text-slate-600 uppercase tracking-tighter bg-white">
                         {{ $skill->pivot->expected_level }}
                    </span>
                </div>
                @endforeach
            </div>

            <!-- Footer Meta -->
            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-lmind-red-mid text-white flex items-center justify-center text-[10px] font-black shadow-lg italic">
                        {{ substr($brief->trainer->user->full_name ?? 'T', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Created By</p>
                        <p class="text-xs font-bold text-slate-700 leading-none italic">{{ $brief->trainer->user->full_name ?? 'Lead Trainer' }}</p>
                    </div>
                </div>

                <form action="{{ route('trainer.briefs.destroy', $brief->id) }}" method="POST" onsubmit="return confirm('Archive this pedagogical brief? This will remove it from the student roadmap.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-[10px] font-black text-slate-300 hover:text-rose-600 uppercase tracking-widest transition-colors">
                        Delete Brief
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-24 text-center bg-white rounded-[4rem] border-2 border-dashed border-slate-200 flex flex-col items-center">
        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-300">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        </div>
        <h4 class="text-xl font-black text-slate-400 uppercase tracking-tighter">No Briefs found</h4>
        <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mt-2 opacity-60">Begin by creating a new pedagogical project brief.</p>
    </div>
    @endforelse
</div>
@endsection
