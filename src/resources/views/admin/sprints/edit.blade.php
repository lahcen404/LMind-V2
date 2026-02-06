@extends('layouts.app')

@section('title', 'Update Sprint')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Navigation Back -->
    <a href="{{ route('admin.sprints.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Back to Timeline
    </a>

    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic text-lmind-navy">Update <span class="text-lmind-red-light">Sprint</span></h1>
        <p class="text-slate-500 text-sm mt-2 font-medium italic underline decoration-lmind-red-light underline-offset-4">
            Modifying Sequence Unit: {{ $sprint->name }}
        </p>
    </div>

    <!-- Edit Form Card -->
    <div class="bg-white rounded-[3rem] shadow-xl border border-slate-100 p-10 relative overflow-hidden">
        <!-- Top Accent Line (Navy for Edit Mode) -->
        <div class="absolute top-0 left-0 w-full h-2 bg-lmind-navy"></div>

        <form action="{{ route('admin.sprints.update', $sprint->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Sprint Name -->
            <div>
                <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Sprint Label / Module Title</label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $sprint->name) }}"
                       required
                       class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-[10px] font-black mt-2 uppercase ml-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Assigned Promotion</label>
                <div class="relative">
                    <select name="training_class_id"
                            disabled
                            class="w-full bg-slate-100 border-2 border-slate-200 rounded-2xl px-6 py-4 text-slate-400 font-bold appearance-none cursor-not-allowed">
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ $sprint->training_class_id == $class->id ? 'selected' : '' }}>
                                {{ $class->name }} ({{ $class->promotion }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <p class="mt-2 text-[9px] font-bold text-slate-400 uppercase tracking-widest italic ml-1">Class re-assignment is restricted to preserve evaluation history.</p>
                <input type="hidden" name="training_class_id" value="{{ $sprint->training_class_id }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Sequence Order -->
                <div>
                    <label for="order_sprint" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Sequence Position (#)</label>
                    <input type="number"
                           name="order_sprint"
                           id="order_sprint"
                           value="{{ old('order_sprint', $sprint->order_sprint) }}"
                           min="1"
                           required
                           class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all">
                    @error('order_sprint')
                        <p class="text-red-500 text-[10px] font-black mt-2 uppercase ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Duration (Weeks)</label>
                    <input type="number"
                           name="duration"
                           id="duration"
                           value="{{ old('duration', $sprint->duration) }}"
                           min="1"
                           required
                           class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 flex flex-col sm:flex-row gap-4">
                <button type="submit" class="flex-1 bg-lmind-red-mid text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl shadow-rose-900/10 hover:bg-lmind-red-dark transition-all active:scale-95">
                    Apply Timeline Updates
                </button>
                <a href="{{ route('admin.sprints.index') }}" class="px-10 py-5 flex items-center justify-center bg-slate-100 text-slate-400 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-200 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
