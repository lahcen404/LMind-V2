@extends('layouts.app')

@section('title', 'Register New Competency')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Navigation -->
    <a href="{{ route('admin.skills.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Back to Library
    </a>

    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Register <span class="text-lmind-red-light">Competency</span></h1>
        <p class="text-slate-500 text-sm mt-2 font-medium">Define a new technical skill to be integrated into training briefs and evaluations.</p>
    </div>

    <!-- Registration Card -->
    <div class="bg-white rounded-[3rem] shadow-xl border border-slate-100 overflow-hidden relative">
        <!-- Top Accent Line -->
        <div class="absolute top-0 left-0 w-full h-2 bg-lmind-red-mid"></div>

        <form action="{{ route('admin.skills.store') }}" method="POST" class="p-10 space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Skill Code (e.g., C1) -->
                <div>
                    <label for="code" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Skill Code</label>
                    <input type="text"
                           name="code"
                           id="code"
                           value="{{ old('code') }}"
                           placeholder="e.g. C1"
                           required
                           class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold uppercase transition-all @error('code') border-rose-500 @enderror">
                    @error('code')
                        <p class="text-rose-500 text-[10px] font-black mt-2 uppercase ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Skill Category (Enum Integration) -->
                <div class="md:col-span-2">
                    <label for="category" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Domain Category</label>
                    <div class="relative">
                        <select name="category"
                                id="category"
                                required
                                class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold appearance-none transition-all cursor-pointer">
                            <option value="">Select Domain...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->value }}" {{ old('category') == $cat->value ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Custom Arrow Icon -->
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3"/></svg>
                        </div>
                    </div>
                    @error('category')
                        <p class="text-rose-500 text-[10px] font-black mt-2 uppercase ml-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Full Skill Name -->
            <div>
                <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Competency Description</label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name') }}"
                       placeholder="e.g. Design and develop a relational database"
                       required
                       class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all @error('name') border-rose-500 @enderror">
                @error('name')
                    <p class="text-rose-500 text-[10px] font-black mt-2 uppercase ml-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Action -->
            <div class="pt-4">
                <button type="submit" class="w-full bg-lmind-navy text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/10 active:scale-95">
                    Deploy Skill to Library
                </button>
            </div>
        </form>
    </div>

    <!-- UI Hint -->
    <div class="mt-8 px-8 py-6 bg-slate-900/5 rounded-3xl border border-dashed border-slate-200">
        <div class="flex items-start gap-4">
            <div class="bg-lmind-navy text-white p-2 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest leading-relaxed">
                Registered skills will be available for trainers to link with <span class="text-lmind-red-mid">Briefs</span> and perform <span class="text-lmind-red-mid">Evaluations</span>.
                Use unique codes like C1, C2... for better tracking.
            </p>
        </div>
    </div>
</div>
@endsection
