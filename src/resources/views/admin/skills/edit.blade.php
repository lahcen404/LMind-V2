@extends('layouts.app')

@section('title', 'Update Competency')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Navigation Back -->
    <a href="{{ route('admin.skills.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Back to Library
    </a>

    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Modify <span class="text-lmind-red-light">Skill</span></h1>
        <p class="text-slate-500 text-sm mt-2 font-medium">Updating details for pedagogical unit: <span class="font-bold text-slate-800 italic underline">{{ $skill->code }} - {{ $skill->name }}</span></p>
    </div>

    <!-- Edit Form Card -->
    <div class="bg-white rounded-[3rem] shadow-xl border border-slate-100 overflow-hidden relative">
        <!-- Top Accent Line (Navy for Edit Mode) -->
        <div class="absolute top-0 left-0 w-full h-2 bg-lmind-navy"></div>

        <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST" class="p-10 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Skill Code -->
                <div>
                    <label for="code" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Skill Reference</label>
                    <input type="text"
                           name="code"
                           id="code"
                           value="{{ old('code', $skill->code) }}"
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
                            @foreach($categories as $cat)
                                <option value="{{ $cat->value }}"
                                    {{ old('category', $skill->category->value ?? $skill->category) == $cat->value ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Competency Name -->
            <div>
                <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Competency Label</label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $skill->name) }}"
                       required
                       class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all @error('name') border-rose-500 @enderror">
                @error('name')
                    <p class="text-rose-500 text-[10px] font-black mt-2 uppercase ml-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="pt-4 flex flex-col sm:flex-row gap-4">
                <button type="submit" class="flex-1 bg-lmind-red-mid text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl shadow-rose-900/10 hover:bg-lmind-red-dark transition-all active:scale-95">
                    Apply Registry Changes
                </button>
                <a href="{{ route('admin.skills.index') }}" class="px-10 py-5 flex items-center justify-center bg-slate-100 text-slate-400 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-200 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Quick Stat Footer -->
    <div class="mt-8 px-8 flex items-center gap-4 text-slate-400">
        <div class="w-2 h-2 rounded-full bg-lmind-navy animate-pulse"></div>
        <p class="text-[10px] font-black uppercase tracking-widest">
            This skill is currently associated with <span class="text-slate-900">{{ $skill->briefs_count ?? 0 }} training briefs</span>
        </p>
    </div>
</div>
@endsection
