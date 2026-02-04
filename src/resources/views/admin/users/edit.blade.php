@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Breadcrumb / Back Link -->
        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-lmind-red-light transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Personnel List
        </a>

        <div class="mb-10">
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Edit <span
                    class="text-lmind-red-light">Personnel</span></h1>
            <p class="text-slate-500 text-sm mt-2 font-medium">Updating account details for: {{ $user->full_name }}</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[3rem] shadow-xl border border-slate-100 overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-2 bg-lmind-navy"></div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-10 space-y-8">
                @csrf
                @method('PUT')

                <!-- Full Name -->
                <div>
                    <label
                        class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Personnel
                        Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                        placeholder="e.g. John Wick"
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold @error('full_name') border-red-500 @enderror">
                    @error('full_name')
                        <p class="text-red-500 text-[10px] font-black mt-2 uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email & Role Group -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">System
                            Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            placeholder="name@lmind.com"
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-[10px] font-black mt-2 uppercase">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Access
                            Role</label>
                        <select name="role"
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold appearance-none">
                            <option value="Learner" {{ old('role', $user->role->value) == 'Learner' ? 'selected' : '' }}>
                                Learner</option>
                            <option value="Trainer" {{ old('role', $user->role->value) == 'Trainer' ? 'selected' : '' }}>
                                Trainer</option>
                            <option value="Admin" {{ old('role', $user->role->value) == 'Admin' ? 'selected' : '' }}> Admin
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Password Initialization -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Update
                        Password</label>
                    <input type="password" name="password" placeholder="New Password"
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-800 focus:outline-none focus:border-lmind-red-light font-bold @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-[10px] font-black mt-2 uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="pt-6 flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-lmind-red-mid text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl shadow-rose-900/10 hover:bg-lmind-red-dark transition active:scale-95">
                        Apply Changes
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                        class="px-8 flex items-center bg-slate-100 text-slate-400 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-200 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
