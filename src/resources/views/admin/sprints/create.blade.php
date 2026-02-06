@extends('layouts.app')

@section('title', 'Schedule Sprint')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Navigation Back -->
    <a href="{{ route('admin.sprints.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Back to Timeline
    </a>

    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Schedule <span class="text-lmind-red-light">Sprint</span></h1>
        <p class="text-slate-500 text-sm mt-2 font-medium italic">Configure a new chronological learning block for the academic registry.</p>
    </div>

    <!-- Creation Card -->
    <div class="bg-white rounded-[3rem] shadow-xl border border-slate-100 p-10 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-lmind-red-mid"></div>

        <form action="{{ route('admin.sprints.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Sprint Name -->
            <div>
                <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Sprint Label / Module Title</label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name') }}"
                       placeholder="e.g. Advanced Backend Logic"
                       required
                       class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-[10px] font-black mt-2 uppercase ml-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Promotion Selection -->
            <div>
                <label for="training_class_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Assign to Promotion</label>
                <div class="relative">
                    <select name="training_class_id"
                            id="training_class_id"
                            required
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold appearance-none transition-all cursor-pointer">
                        <option value="">Select the target class...</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ (old('training_class_id') == $class->id || request('training_class_id') == $class->id) ? 'selected' : '' }}>
                                {{ $class->name }} ({{ $class->promotion }})
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3"/></svg>
                    </div>
                </div>
                @error('training_class_id')
                    <p class="text-red-500 text-[10px] font-black mt-2 uppercase ml-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Order Sprint -->
                <div>
                    <label for="order_sprint" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Sequence Position (#)</label>
                    <input type="number"
                           name="order_sprint"
                           id="order_sprint"
                           value="{{ old('order_sprint', 1) }}"
                           min="1"
                           required
                           class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all">
                    <p class="mt-2 text-[9px] text-slate-400 font-bold uppercase tracking-tight ml-1">Defines the chronological order (e.g. 1st, 2nd, 3rd...)</p>
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Duration (Weeks)</label>
                    <input type="number"
                           name="duration"
                           id="duration"
                           value="{{ old('duration', 2) }}"
                           min="1"
                           required
                           class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all">
                </div>
            </div>

            <!-- Submit Action -->
            <div class="pt-4">
                <button type="submit" class="w-full bg-lmind-navy text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-800 transition shadow-xl active:scale-95">
                    Deploy Sprint to Registry
                </button>
            </div>
        </form>
    </div>

    <!-- Pedagogical Note -->
    <div class="mt-8 px-10 py-6 bg-slate-100 rounded-3xl border-2 border-dashed border-slate-200">
        <div class="flex items-start gap-4">
            <div class="w-8 h-8 rounded-xl bg-lmind-red-mid text-white flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest leading-relaxed">
                Sprints define the temporal structure of a class. Once created, Trainers can assign <span class="text-lmind-red-mid">Briefs</span> to these specific time blocks to organize the learner's journey.
            </p>
        </div>
    </div>
</div>
@endsection
