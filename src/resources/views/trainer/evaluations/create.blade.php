@extends('layouts.app')

@section('title', 'Skill Assessment')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header: Student & Brief Identity -->
    <div class="mb-10 flex flex-col md:flex-row justify-between items-start gap-6">
        <div>
            <a href="{{ route('trainer.dashboard') }}" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition flex items-center gap-2 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                Return to Dashboard
            </a>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic leading-none">Skill <span class="text-lmind-red-light">Assessment</span></h1>
            <p class="text-slate-500 text-sm mt-3 font-medium">Evaluating <span class="text-slate-900 font-bold uppercase">{{ $learner->user->full_name }}</span> for <span class="italic underline decoration-lmind-red-light">"{{ $brief->title }}"</span></p>
        </div>

        <!-- Livrable Inspection Link -->
        @if($livrable)
        <a href="{{ $livrable->url }}" target="_blank" class="bg-lmind-navy text-white px-8 py-5 rounded-[2rem] font-black text-xs uppercase tracking-widest hover:bg-lmind-red-mid transition-all shadow-xl flex items-center gap-3 active:scale-95 group">
            <svg class="w-5 h-5 text-rose-400 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            Inspect Livrable
        </a>
        @else
        <div class="bg-slate-100 text-slate-400 px-8 py-5 rounded-[2rem] font-black text-xs uppercase tracking-widest border border-dashed border-slate-200 cursor-not-allowed">
            No Livrable Deployed
        </div>
        @endif
    </div>

    <form action="{{ route('trainer.evaluations.store', [$brief->id, $learner->id]) }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <!-- LEFT: Skill Assessment Loop -->
            <div class="lg:col-span-8 space-y-8">
                <div class="bg-white p-10 rounded-[3.5rem] border border-slate-100 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-lmind-red-mid"></div>
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-10 italic">Performance Criteria (DNA Mapping)</h3>

                    <div class="space-y-12">
                        @foreach($brief->skills as $skill)
                        @php
                            // Check if an assessment already exists for this skill (for editing)
                            $existing = $existingEvaluations->get($skill->id);
                        @endphp
                        <div class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 transition-all hover:bg-white hover:border-lmind-red-light/20 hover:shadow-xl group">
                            <div class="flex justify-between items-start mb-8">
                                <div>
                                    <span class="text-[10px] font-black bg-lmind-navy text-white px-3 py-1 rounded-lg uppercase tracking-widest italic shadow-md">{{ $skill->code }}</span>
                                    <h4 class="text-lg font-black text-slate-800 mt-3 group-hover:text-lmind-red-mid transition-colors italic leading-tight">{{ $skill->name }}</h4>
                                </div>
                                <div class="text-right">
                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Brief Target</p>
                                    <span class="text-[10px] font-black text-lmind-navy uppercase italic">Level: {{ $skill->pivot->expected_level }}</span>
                                </div>
                            </div>

                            <!-- Mastery Level Selection (Triple-A) -->
                            <div class="grid grid-cols-3 gap-4 mb-8">
                                @foreach(\App\Enums\MasteryLevel::cases() as $level)
                                <label class="relative cursor-pointer group/radio">
                                    <input type="radio"
                                           name="skills[{{ $skill->id }}][achieved_level]"
                                           value="{{ $level->value }}"
                                           class="peer sr-only"
                                           required
                                           {{ ($existing && $existing->achieved_level == $level) ? 'checked' : '' }}>
                                    <div class="p-4 rounded-2xl border-2 border-slate-200 text-center transition-all peer-checked:border-lmind-red-mid peer-checked:bg-lmind-red-mid peer-checked:text-white hover:border-lmind-red-light bg-white">
                                        <p class="text-[10px] font-black uppercase tracking-tighter">{{ $level->name }}</p>
                                    </div>
                                </label>
                                @endforeach
                            </div>

                            <!-- Skill Specific Feedback -->
                            <textarea name="skills[{{ $skill->id }}][comment]" rows="2"
                                      placeholder="Specific feedback for this competency..."
                                      class="w-full bg-white border-2 border-slate-100 rounded-2xl px-6 py-4 text-xs font-bold focus:border-lmind-red-light focus:outline-none transition-all italic">{{ $existing->comment ?? '' }}</textarea>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- RIGHT: Validation Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-lmind-navy p-10 rounded-[3.5rem] shadow-2xl relative overflow-hidden group sticky top-8">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-lmind-red-mid opacity-5 rounded-full blur-3xl group-hover:opacity-10 transition-opacity"></div>

                    <h3 class="text-[10px] font-black text-rose-400 uppercase tracking-[0.3em] mb-10 italic">Final Validation</h3>

                    <div class="space-y-10">
                        <div class="p-6 bg-slate-900/50 rounded-2xl border border-slate-800">
                            <h5 class="text-[10px] font-black mb-4 italic text-slate-300 uppercase tracking-widest">Assessment Logic</h5>
                            <ul class="space-y-3 text-[9px] font-bold text-slate-500 leading-relaxed uppercase tracking-tighter">
                                <li class="flex gap-2"><span class="text-lmind-red-light">●</span> IMITER: Reproduced with guidance.</li>
                                <li class="flex gap-2"><span class="text-lmind-red-light">●</span> ADAPTER: Modified autonomously.</li>
                                <li class="flex gap-2"><span class="text-lmind-red-light">●</span> TRANSPOSER: Innovated new context.</li>
                            </ul>
                        </div>

                        <button type="submit" class="w-full bg-white text-lmind-navy py-6 rounded-[2rem] font-black uppercase tracking-[0.2em] text-xs hover:bg-lmind-red-mid hover:text-white transition-all active:scale-95 shadow-2xl">
                            Validate Assessment
                        </button>

                        <p class="text-center text-[9px] font-black text-slate-600 uppercase tracking-widest leading-relaxed">
                            Validated marks will be reflected in the learner's skill roadmap immediately.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
