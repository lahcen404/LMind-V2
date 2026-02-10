@extends('layouts.app')

@section('title', 'My Promotions')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
    <div>
        <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">Pedagogical Deck</span>
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">My <span class="text-lmind-red-light">Promotions</span></h1>
    </div>

    <div class="flex items-center gap-4 bg-white px-6 py-3 rounded-2xl border border-slate-100 shadow-sm">
        <div class="w-10 h-10 rounded-xl bg-lmind-navy text-white flex items-center justify-center font-black italic">
            {{ $classes->count() }}
        </div>
        <div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Active Classes</p>
            <p class="text-xs font-bold text-slate-800 uppercase tracking-tight italic">Assigned to you</p>
        </div>
    </div>
</div>

<!-- Classes Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($classes as $class)
    <div class="bg-white rounded-[3rem] border-b-8 border-slate-200 p-10 hover:border-lmind-red-light transition-all group shadow-sm flex flex-col relative overflow-hidden">
        <!-- Top Status Bar -->
        <div class="flex justify-between items-start mb-8">
            <div class="w-16 h-16 bg-slate-900 text-white rounded-[1.5rem] flex items-center justify-center font-black text-2xl shadow-inner group-hover:bg-lmind-red-mid transition-colors uppercase italic">
                {{ substr($class->name, 0, 1) }}
            </div>
            <div class="text-right">
                <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest bg-emerald-50 px-4 py-1.5 rounded-full border border-emerald-100">
                    Active
                </span>
                <p class="text-[10px] font-bold text-slate-400 mt-2 uppercase tracking-widest">{{ $class->promotion }}</p>
            </div>
        </div>

        <!-- Class Details -->
        <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tighter mb-2 group-hover:text-lmind-red-mid transition-colors">{{ $class->name }}</h3>

        <div class="flex items-center gap-2 mb-8">
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest italic">
                <span class="text-slate-900 font-black">{{ $class->learners_count }}</span> Enrolled Learners
            </p>
        </div>

        <!-- Action Area -->
        <div class="mt-auto pt-8 border-t border-slate-50">
            <a href="{{ route('trainer.classes.assign', $class->id) }}" class="w-full bg-lmind-navy text-white py-5 rounded-[2rem] text-[10px] font-black uppercase tracking-[0.2em] hover:bg-lmind-red-mid transition-all text-center flex items-center justify-center gap-3 shadow-xl shadow-slate-900/10 active:scale-95 group/btn">
                <svg class="w-4 h-4 group-hover/btn:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Manage Roster
            </a>

            <a href="{{ route('trainer.dashboard') }}" class="block w-full text-center mt-4 text-[10px] font-black text-slate-300 hover:text-slate-500 uppercase tracking-widest transition-colors">
                View Class Analytics
            </a>
        </div>
    </div>
    @empty
    <div class="col-span-full py-24 text-center bg-white rounded-[4rem] border-2 border-dashed border-slate-200">
        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        </div>
        <h4 class="text-xl font-black text-slate-400 uppercase tracking-tighter">No Assigned Classes</h4>
        <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mt-2 opacity-60">You are not currently linked to any active training promotions.</p>
    </div>
    @endforelse
</div>
@endsection
