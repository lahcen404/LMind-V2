@extends('layouts.app')

@section('title', 'Create Promotion')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Breadcrumb / Back Link -->
    <a href="{{ route('admin.classes.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Back to Registry
    </a>

    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Promotion <span class="text-lmind-red-light">Setup</span></h1>
        <p class="text-slate-500 text-sm mt-2 font-medium">Initialize a new academic group and assign a lead trainer to the deck.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-[3rem] shadow-xl border border-slate-100 overflow-hidden relative p-10">
        <div class="absolute top-0 left-0 w-full h-2 bg-lmind-red-mid"></div>

        <form action="{{ route('admin.classes.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Class Name -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Class Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Web Development" required
                           class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all @error('name') border-lmind-red-light @enderror">
                    @error('name')
                        <p class="text-lmind-red-mid text-[10px] font-black uppercase mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Promotion Tag (Fixes the SQL Error) -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Promotion Tag / Year</label>
                    <input type="text" name="promotion" value="{{ old('promotion') }}" placeholder="e.g. 2026-A" required
                           class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all @error('promotion') border-lmind-red-light @enderror">
                    @error('promotion')
                        <p class="text-lmind-red-mid text-[10px] font-black uppercase mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Lead Trainer Assignment -->
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Assign Lead Trainer</label>
                <div class="relative">
                    <select name="user_id" required
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold appearance-none transition-all @error('user_id') border-lmind-red-light @enderror">
                        <option value="">Select from pedagogical team...</option>
                        @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}" {{ old('user_id') == $trainer->id ? 'selected' : '' }}>
                                {{ $trainer->full_name }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Custom Arrow -->
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3"/></svg>
                    </div>
                </div>
                @error('user_id')
                    <p class="text-lmind-red-mid text-[10px] font-black uppercase mt-2 ml-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-lmind-navy text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-800 transition shadow-xl shadow-slate-900/10 active:scale-95">
                Launch Promotion
            </button>
        </form>
    </div>
</div>
@endsection
