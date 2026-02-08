@extends('layouts.app')

@section('title', 'Draft New Brief')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Navigation Back -->
    <a href="{{ route('trainer.briefs.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Back to Brief Registry
    </a>

    <div class="mb-10 text-center md:text-left">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic leading-none">
            New <span class="text-lmind-red-light">Pedagogical Brief</span>
        </h1>
        <p class="text-slate-500 text-sm mt-3 font-medium">Define a technical project, assign it to a promotion, and map the required skill levels.</p>
    </div>

    <form action="{{ route('trainer.briefs.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- LEFT: Main Project Data (8/12) -->
            <div class="lg:col-span-8 space-y-8">
                <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-lmind-red-mid"></div>

                    <div class="space-y-8">
                        <!-- Project Title -->
                        <div>
                            <label for="title" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Project Identity / Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="e.g. Refactoring an E-Commerce Backend" required
                                   class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all @error('title') border-lmind-red-mid @enderror">
                            @error('title') <p class="text-lmind-red-mid text-[10px] font-black mt-2 uppercase ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Project Type (Schema: type) -->
                            <div>
                                <label for="type" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Project Modality</label>
                                <div class="relative">
                                    <select name="type" id="type" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold appearance-none transition-all cursor-pointer">
                                          @foreach(\App\Enums\BriefType::cases() as $type)
                                            <option value="{{ $type->value }}" {{ old('type') == $type->value ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3"/></svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Duration (Schema: duration) -->
                            <div>
                                <label for="duration" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Allocated Time (Weeks)</label>
                                <input type="number" name="duration" id="duration" value="{{ old('duration', 1) }}" min="1" required
                                       class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all">
                            </div>
                        </div>

                        <!-- Detailed Description -->
                        <div>
                            <label for="description" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Context & Technical Instructions</label>
                            <textarea name="description" id="description" rows="12" placeholder="Detail the technical deliverables, constraints, and provided resources..." required
                                      class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold transition-all @error('description') border-lmind-red-mid @enderror">{{ old('description') }}</textarea>
                            @error('description') <p class="text-lmind-red-mid text-[10px] font-black mt-2 uppercase ml-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Selection Sidebar (4/12) -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Class Assignment (Direct to Training Class) -->
                <div class="bg-lmind-navy p-8 rounded-[3rem] shadow-2xl relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-lmind-red-mid opacity-10 rounded-full blur-2xl transition-opacity"></div>

                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] mb-6 text-rose-400">Target Promotion</h3>
                    <div class="relative">
                        <select name="training_class_id" required
                                class="w-full bg-slate-900 border-2 border-slate-800 rounded-xl px-4 py-3 font-bold text-sm text-white focus:border-lmind-red-light focus:outline-none appearance-none cursor-pointer">
                            <option value="">Select a class...</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('training_class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }} ({{ $class->promotion }})
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Skill Selection Mapping -->
                <div class="bg-white p-8 rounded-[3rem] shadow-xl border border-slate-100 relative">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] mb-8 text-slate-400 flex items-center gap-2 border-l-2 border-lmind-red-light pl-3">
                        Skill Framework
                    </h3>

                    <div class="space-y-4 max-h-[500px] overflow-y-auto custom-scrollbar pr-2">
                        @foreach($skills as $skill)
                        <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl transition-all hover:bg-white hover:border-lmind-red-light hover:shadow-lg">
                            <label class="flex items-center justify-between cursor-pointer mb-3">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" name="skills[]" value="{{ $skill->id }}"
                                           class="w-4 h-4 rounded border-slate-300 text-lmind-red-mid focus:ring-lmind-red-light">
                                    <span class="text-xs font-black text-slate-800 uppercase tracking-widest italic leading-none">{{ $skill->code }}</span>
                                </div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-tighter">{{ $skill->category->name ?? 'Core' }}</span>
                            </label>

                            <div class="flex flex-col gap-1 bg-white p-2 rounded-xl border border-slate-100 shadow-inner">
                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest pl-1">Required Level</span>
                                {{-- Use SkillLevel Enum values --}}
                                <select name="levels[{{ $skill->id }}]" class="bg-transparent text-slate-900 text-[10px] font-black uppercase focus:outline-none cursor-pointer">
                                    @foreach($skillLevels as $level)
                                        <option value="{{ $level->value }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="w-full bg-lmind-red-mid hover:bg-lmind-red-light text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs mt-10 transition-all active:scale-95 shadow-xl shadow-rose-900/20">
                        Deploy Brief
                    </button>
                </div>

                <!-- Pedagogical Helper -->
                <div class="p-4 px-6">
                    <p class="text-[10px] font-bold text-slate-400 leading-relaxed uppercase tracking-tighter italic">
                        By assigning a <span class="text-lmind-navy font-black">Brief</span> directly to a <span class="text-lmind-navy font-black">Class</span>, you establish the roadmap for all learners in that promotion.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
