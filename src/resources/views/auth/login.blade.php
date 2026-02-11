@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Branding Header -->
        <div class="text-center">
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">
                Authorized <span class="text-lmind-red-light">Access</span>
            </h1>
            <p class="mt-2 text-sm text-slate-500 font-medium tracking-wide">
                Identify yourself to access the platform
            </p>
        </div>

        <!-- Login Form Card -->
        <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-xl border border-slate-100 relative overflow-hidden">
            <!-- Top Color Accent -->
            <div class="absolute top-0 left-0 w-full h-1.5 bg-lmind-red-mid"></div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">
                        System Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-lmind-red-light focus:bg-white transition-all text-sm font-semibold @error('email') border-lmind-red-light @enderror"
                        placeholder="operator@lmind.com">
                    @error('email')
                        <p class="text-xs text-lmind-red-light mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">
                        Security Key
                    </label>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-lmind-red-light focus:bg-white transition-all text-sm font-semibold @error('password') border-lmind-red-light @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-xs text-lmind-red-light mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between px-1">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-lmind-red-mid focus:ring-lmind-red-light border-slate-300 rounded">
                        <label for="remember_me" class="ml-2 block text-[10px] font-black text-slate-400 uppercase tracking-widest cursor-pointer">
                            Keep session active
                        </label>
                    </div>
                </div>

                <!-- Entry Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-xs font-black rounded-2xl text-white bg-lmind-navy hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lmind-red-mid uppercase tracking-[0.2em] shadow-xl transition-all active:scale-95">
                        Authorize Entry
                    </button>
                </div>

                <!-- Support Link -->
                <div class="text-center">
                    <a href="#" class="text-[10px] font-black text-slate-400 hover:text-lmind-red-light uppercase tracking-widest transition">
                        Trouble signing in?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
