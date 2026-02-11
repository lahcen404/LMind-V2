@extends('layouts.app')

@section('title', 'Manage Roster')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div>
            <a href="{{ route('trainer.classes.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                Back to Dashboard
            </a>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Manage <span class="text-lmind-red-light">Roster</span></h1>
            <p class="text-slate-500 text-sm mt-2 font-medium italic">Promotion: <span class="text-slate-900 font-bold underline decoration-lmind-red-light">{{ $class->name }}</span></p>
        </div>

        <div class="bg-lmind-navy px-6 py-4 rounded-3xl text-white shadow-xl flex items-center gap-4">
            <div class="text-right">
                <p class="text-[10px] font-black text-rose-400 uppercase tracking-widest">Enrolled</p>
                <p class="text-xl font-black italic">{{ $currentLearners->count() }} Students</p>
            </div>
            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-lmind-red-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </div>
    </div>

    <form action="{{ route('trainer.classes.sync', $class->id) }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- CURRENT ROSTER -->
            <div class="space-y-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em] ml-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Currently Enrolled
                </h3>

                <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden p-2">
                    <!-- SCROLLABLE CONTAINER -->
                    <div class="max-h-[500px] overflow-y-auto custom-scrollbar p-4 space-y-4">
                        @forelse($currentLearners as $learner)
                        <label class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border-2 border-transparent hover:border-lmind-red-light transition-all cursor-pointer group">
                            <div class="flex items-center gap-4">
                                <input type="checkbox" name="learner_ids[]" value="{{ $learner->id }}" checked class="w-5 h-5 rounded border-slate-300 text-lmind-red-mid focus:ring-lmind-red-light">
                                <div>
                                    <p class="font-black text-slate-800 uppercase tracking-tight text-sm">{{ $learner->user->full_name }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $learner->user->email }}</p>
                                </div>
                            </div>
                            <span class="text-[8px] font-black text-emerald-500 uppercase tracking-widest group-hover:hidden">Active Member</span>
                        </label>
                        @empty
                        <div class="py-10 text-center text-slate-400 italic text-sm">No students assigned to this class yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- AVAILABLE POOL -->
            <div class="space-y-6">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em] ml-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    Available Students (Pool)
                </h3>

                <div class="bg-lmind-navy rounded-[3rem] shadow-2xl p-4 overflow-hidden">
                    <!-- SCROLLABLE CONTAINER -->
                    <div class="max-h-[500px] overflow-y-auto custom-scrollbar p-6 space-y-4">
                        @forelse($availableLearners as $learner)
                        <label class="flex items-center gap-4 p-4 bg-slate-800/50 rounded-2xl border border-slate-700 hover:border-rose-500 transition-all cursor-pointer group">
                            <input type="checkbox" name="learner_ids[]" value="{{ $learner->id }}" class="w-5 h-5 rounded border-slate-600 bg-slate-900 text-lmind-red-mid focus:ring-lmind-red-light">
                            <div>
                                <p class="font-black text-white uppercase tracking-tight text-sm">{{ $learner->user->full_name }}</p>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest italic">Waiting for assignment...</p>
                            </div>
                        </label>
                        @empty
                        <div class="py-20 text-center">
                            <svg class="w-12 h-12 text-slate-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                            <p class="text-slate-500 font-black uppercase tracking-widest text-[10px]">Pool is currently empty</p>
                        </div>
                        @endforelse
                    </div>

                    @if($availableLearners->count() > 0 || $currentLearners->count() > 0)
                    <div class="p-4 pt-2">
                        <button type="submit" class="w-full bg-lmind-red-mid hover:bg-lmind-red-light text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs transition-all active:scale-95 shadow-xl shadow-rose-900/40">
                            Synchronize Class Roster
                        </button>
                    </div>
                    @endif
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                            <span class="text-slate-900">Pro-Tip:</span> Use the scrollbar if the list of students exceeds the viewable area. Unassigned students return to the pool automatically.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
