@extends('layouts.app')

@section('title', 'Skill Library')

@section('content')
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
    <div>
        <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">Pedagogical DNA</span>
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Skill <span class="text-lmind-red-light">Library</span></h1>
    </div>

    <a href="{{ route('admin.skills.create') }}" class="bg-lmind-navy text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-lmind-red-mid transition-all shadow-xl shadow-slate-900/10 active:scale-95 flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
        New Competency
    </a>
</div>

<!-- Skills Grouped by Category -->
<div class="space-y-12">
    @forelse($skills as $categoryName => $categorySkills)
        <div>
            <!-- Category Divider -->
            <div class="flex items-center gap-4 mb-6 px-4">
                <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em] whitespace-nowrap">{{ $categoryName }}</h2>
                <div class="flex-1 h-px bg-slate-200"></div>
                <span class="text-[10px] font-bold text-slate-400 italic uppercase">{{ $categorySkills->count() }} Skills</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categorySkills as $skill)
                <div class="bg-white rounded-[2.5rem] border-b-8 border-slate-100 p-8 hover:border-lmind-red-light transition-all group shadow-sm">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-slate-900 text-white rounded-xl flex items-center justify-center font-black text-sm group-hover:bg-lmind-red-mid transition-colors italic shadow-inner">
                            {{ $skill->code }}
                        </div>

                        @php
                            // collors badges
                            $colorClass = match($skill->category->value ?? $skill->category) {
                                'FRONTEND' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                'BACKEND' => 'bg-blue-50 text-blue-600 border-blue-100',
                                'DEVOPS' => 'bg-amber-50 text-amber-600 border-amber-100',
                                'SOFTSKILLS' => 'bg-purple-50 text-purple-600 border-purple-100',
                                default => 'bg-slate-50 text-slate-600 border-slate-100'
                            };
                        @endphp
                        <span class="text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-full border {{ $colorClass }}">
                            {{ is_object($skill->category) ? $skill->category->name : $skill->category }}
                        </span>
                    </div>

                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-tighter mb-6 leading-tight min-h-[3rem]">{{ $skill->name }}</h3>

                    <div class="flex gap-2 border-t border-slate-50 pt-6">
                        <a href="{{ route('admin.skills.edit', $skill->id) }}" class="flex-1 bg-slate-50 text-slate-400 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-lmind-navy hover:text-white transition-all text-center">
                            Modify
                        </a>

                        <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this skill?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-12 h-full bg-slate-50 text-slate-300 rounded-xl hover:bg-lmind-red-mid hover:text-white transition-all flex items-center justify-center py-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-200">
            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
            </div>
            <p class="text-slate-400 font-black uppercase tracking-widest italic opacity-50">Skill library is currently empty.</p>
        </div>
    @endforelse
</div>
@endsection
