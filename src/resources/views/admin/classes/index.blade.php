@extends('layouts.app')

@section('title', 'Class Registry')

@section('content')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
    <div>
        <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">Pedagogical Registry</span>
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Training <span class="text-lmind-red-light">Promotions</span></h1>
    </div>

    <a href="{{ route('admin.classes.create') }}" class="bg-lmind-navy text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-lmind-red-mid transition-all shadow-xl shadow-slate-900/10 active:scale-95 flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
        Launch New Deck
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($classes as $class)
    <div class="bg-white rounded-[2.5rem] border-b-8 border-slate-200 p-8 hover:border-lmind-red-light transition-all group shadow-sm">
        <div class="flex justify-between items-start mb-6">
            <div class="w-14 h-14 bg-slate-900 text-white rounded-2xl flex items-center justify-center font-black text-xl shadow-inner group-hover:bg-lmind-red-mid transition-colors uppercase">
                {{ substr($class->name, 0, 1) }}
            </div>
            <div class="text-right">
                <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest bg-emerald-50 px-3 py-1 rounded-full">Active</span>
                <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ $class->promotion }}</p>
            </div>
        </div>

        <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter mb-1">{{ $class->name }}</h3>
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6 italic">Registry ID #{{ $class->id }}</p>

        <div class="space-y-4 mb-8">
            <!-- Lead Trainer Info -->
            <div class="flex items-center gap-3 bg-slate-50 p-3 rounded-2xl border border-slate-100">
                <div class="w-8 h-8 rounded-xl bg-lmind-navy text-white flex items-center justify-center text-[10px] font-black shadow-sm">
                    {{ substr($class->main_trainer->full_name ?? '?', 0, 1) }}
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Lead Trainer</p>
                    <p class="text-xs font-bold text-slate-700 leading-none">
                        {{ $class->main_trainer->full_name ?? 'Unassigned' }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 px-1">
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2"/></svg>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $class->learners_count ?? $class->learners->count() }} Learners Enrolled</p>
            </div>
        </div>

        <div class="flex gap-2 pt-2 border-t border-slate-50">
            <a href="{{ route('admin.classes.edit', $class->id) }}" class="flex-1 bg-lmind-navy text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-lmind-red-mid transition-all text-center flex items-center justify-center gap-2 shadow-lg shadow-slate-900/10">
                Edit Deck
            </a>

            <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" class="inline" onsubmit="return confirm('Archive this promotion?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-12 h-12 bg-slate-100 text-slate-400 rounded-xl hover:bg-lmind-red-mid hover:text-white transition-all flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-full py-20 text-center">
        <p class="text-slate-400 font-black uppercase tracking-widest italic">No promotions found in the registry.</p>
    </div>
    @endforelse
</div>
@endsection
