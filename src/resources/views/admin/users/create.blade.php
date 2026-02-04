@extends('layouts.app')

@section('title', 'Register New User')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Back to Personnel List
    </a>

    <div class="bg-white rounded-[3rem] shadow-xl border border-slate-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-lmind-red-mid"></div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="p-10 space-y-8">
            @csrf

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Personnel Full Name</label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="e.g. John Wick" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold @error('full_name') border-red-500 @enderror">
                @error('full_name') <p class="text-red-500 text-[10px] font-black mt-2 uppercase">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">System Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="name@lmind.com" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold @error('email') border-red-500 @enderror">
                    @error('email') <p class="text-red-500 text-[10px] font-black mt-2 uppercase">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Access Role</label>
                    <select name="role" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold appearance-none">

                        <option value="Learner" {{ old('role') == 'Learner' ? 'selected' : '' }}>Learner</option>
                        <option value="Trainer" {{ old('role') == 'Trainer' ? 'selected' : '' }}>Trainer</option>
                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>System Admin</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Initial Password</label>
                <input type="password" name="password" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold">
                @error('password') <p class="text-red-500 text-[10px] font-black mt-2 uppercase">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-lmind-navy text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-800 transition shadow-xl shadow-slate-900/10">
                Deploy User to System
            </button>
        </form>
    </div>
</div>
@endsection
