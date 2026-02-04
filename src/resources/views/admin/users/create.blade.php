@extends('layouts.app')

@section('title', 'Register New User')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Breadcrumb / Back Link -->
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Back to Personnel List
    </a>

    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">User <span class="text-lmind-red-light">Registration</span></h1>
        <p class="text-slate-500 text-sm mt-2 font-medium">Add a new operator, trainer, or learner to the system deck.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-[3rem] shadow-xl border border-slate-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-lmind-red-mid"></div>

        <form class="p-10 space-y-8">
            <!-- Full Name -->
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Personnel Full Name</label>
                <input type="text" placeholder="e.g. John Wick" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 placeholder-slate-300 focus:outline-none focus:border-lmind-red-light focus:bg-white transition-all font-bold">
            </div>

            <!-- Email & Role Group -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">System Email</label>
                    <input type="email" placeholder="name@lmind.com" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 placeholder-slate-300 focus:outline-none focus:border-lmind-red-light focus:bg-white transition-all font-bold">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Access Role</label>
                    <select class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light focus:bg-white transition-all font-bold appearance-none">
                        <option value="LEARNER">Learner (Student)</option>
                        <option value="TRAINER">Trainer (Pedagogy)</option>
                        <option value="ADMIN">System Admin</option>
                    </select>
                </div>
            </div>

            <!-- Password Initialization -->
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Temporary Security Key</label>
                <div class="relative">
                    <input type="password" value="LMind_Default_2026" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light focus:bg-white transition-all font-bold">
                    <span class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-lmind-red-mid uppercase cursor-pointer">Generate</span>
                </div>
                <p class="mt-3 text-[10px] font-bold text-slate-400 italic">User will be prompted to change this key upon first authorization.</p>
            </div>

            <!-- Actions -->
            <div class="pt-6 flex gap-4">
                <button type="submit" class="flex-1 bg-lmind-navy text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl shadow-slate-900/10 hover:bg-slate-800 transition active:scale-95">
                    Deploy User to System
                </button>
                <button type="button" class="px-8 bg-slate-100 text-slate-400 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-200 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
