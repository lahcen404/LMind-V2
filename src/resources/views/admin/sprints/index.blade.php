@extends('layouts.app')

@section('title', 'Academic Timeline')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
    <div>
        <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">Pedagogical Flow</span>
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Sprint <span class="text-lmind-red-light">Timeline</span></h1>
    </div>

    <a href="{{ route('admin.sprints.create') }}" class="bg-lmind-navy text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-lmind-red-mid transition-all shadow-xl shadow-slate-900/10 active:scale-95 flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
        New Sprint
    </a>
</div>

<!-- Timeline by Class -->
<div class="space-y-12">
    @forelse($classes as $class)
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
            <!-- Class Header Banner -->
            <div class="bg-lmind-navy px-10 py-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-lmind-red-mid text-white flex items-center justify-center font-black italic shadow-lg shadow-rose-950/20">
                        {{ substr($class->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-white uppercase tracking-tight">{{ $class->name }}</h2>
                        <p class="text-[10px] font-bold text-rose-300 uppercase tracking-widest italic">{{ $class->promotion }}</p>
                    </div>
                </div>
                <div class="px-4 py-2 bg-slate-800/50 rounded-xl border border-slate-700">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sequence Depth: {{ $class->sprints->count() }} Sprints</span>
                </div>
            </div>

            <!-- Sprint Sequence Grid -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($class->sprints as $sprint)
                        <div class="group relative bg-slate-50 border-2 border-transparent hover:border-lmind-red-light rounded-[2.5rem] p-8 transition-all duration-300">
                            <!-- Sequence Indicator -->
                            <div class="flex justify-between items-start mb-6">
                                <span class="text-[10px] font-black bg-slate-900 text-white px-4 py-1.5 rounded-full uppercase tracking-widest italic shadow-sm group-hover:bg-lmind-red-mid transition-colors">
                                    Sprint #{{ $sprint->order_sprint }}
                                </span>

                                <div class="flex gap-2">
                                    <a href="{{ route('admin.sprints.edit', $sprint->id) }}" class="p-2 text-slate-300 hover:text-lmind-navy transition-colors" title="Edit Sprint">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                </div>
                            </div>

                            <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight mb-2">{{ $sprint->name }}</h3>

                            <div class="flex items-center gap-2 mb-8 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-[10px] font-bold uppercase tracking-widest">Duration: <span class="text-slate-900 font-black">{{ $sprint->duration }} Weeks</span></p>
                            </div>

                            <!-- Footer Actions -->
                            <div class="flex items-center justify-between pt-4 border-t border-slate-200/60">
                                <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest italic">Pedagogical Unit</span>

                                <form action="{{ route('admin.sprints.destroy', $sprint->id) }}" method="POST" onsubmit="return confirm('Remove this sprint from the academic calendar?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[9px] font-black text-slate-300 hover:text-rose-600 uppercase tracking-widest transition-colors">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <!-- Quick Add Card -->
                    <a href="{{ route('admin.sprints.create', ['training_class_id' => $class->id]) }}" class="flex flex-col items-center justify-center p-8 rounded-[2.5rem] border-2 border-dashed border-slate-200 text-slate-300 hover:border-lmind-red-light hover:text-lmind-red-light transition-all group min-h-[220px]">
                        <div class="w-12 h-12 rounded-2xl bg-slate-50 border-2 border-slate-100 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-rose-50 group-hover:border-rose-100 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest">Append Sprint</span>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-200">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <p class="text-slate-400 font-black uppercase tracking-widest italic">No promotions found in registry. Initialize a class to manage its timeline.</p>
        </div>
    @endforelse
</div>
@endsection
