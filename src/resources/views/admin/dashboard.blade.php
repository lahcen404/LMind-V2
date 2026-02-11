@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Page Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
    <div>
        <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">Administration Deck</span>
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Global <span class="text-lmind-red-light">System</span> Overview</h1>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden lg:block text-right">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Server Status</p>
            <p class="text-xs font-bold text-emerald-500 flex items-center justify-end gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Operational
            </p>
        </div>
        <button class="bg-lmind-navy text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-lmind-red-mid transition-all shadow-xl shadow-slate-900/10 active:scale-95">
            + New Promotion
        </button>
    </div>
</div>

<!-- Key Performance Indicators (Stats) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <!-- Total Learners -->
    <div class="group bg-white p-8 rounded-[2.5rem] border-b-4 border-slate-200 hover:border-lmind-red-light shadow-sm transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-lmind-red-mid group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <span class="text-[10px] font-black text-emerald-500">+4% week</span>
        </div>
        <p class="text-3xl font-black text-slate-800 tracking-tighter">{{ $learnersCount ?? '124' }}</p>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Learners Enrolled</p>
    </div>

    <!-- Active Trainers -->
    <div class="group bg-white p-8 rounded-[2.5rem] border-b-4 border-slate-200 hover:border-lmind-navy shadow-sm transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-lmind-navy group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-black text-slate-800 tracking-tighter">{{ $trainersCount ?? '8' }}</p>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Pedagogical Team</p>
    </div>

    <!-- Active Promotions -->
    <div class="group bg-white p-8 rounded-[2.5rem] border-b-4 border-slate-200 hover:border-indigo-500 shadow-sm transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        </div>
        <p class="text-3xl font-black text-slate-800 tracking-tighter">{{ $classesCount ?? '12' }}</p>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Active Promotions</p>
    </div>

    <!-- Skill Count -->
    <div class="group bg-white p-8 rounded-[2.5rem] border-b-4 border-slate-200 hover:border-emerald-500 shadow-sm transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-black text-slate-800 tracking-tighter">{{ $skillsCount ?? '42' }}</p>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Registered Skills</p>
    </div>
</div>

<!-- Active Classes Management Table -->
<div class="bg-lmind-navy rounded-[2.5rem] p-2 shadow-2xl overflow-hidden relative">
    <!-- Navy theme background elements for depth -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-lmind-red-mid opacity-5 rounded-full blur-3xl -mr-20 -mt-20"></div>

    <div class="bg-white rounded-[2.2rem] overflow-hidden relative z-10">
        <div class="px-10 py-8 border-b border-slate-50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter">Current Training Programs</h3>
                <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest italic">Academic Cycle 2026</p>
            </div>
            <div class="flex gap-2">
                <div class="px-4 py-2 bg-slate-50 rounded-xl text-[10px] font-black text-slate-500 uppercase tracking-widest border border-slate-100 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    {{ $classesCount ?? '12' }} Classes Active
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] uppercase font-black text-slate-400 bg-slate-50/50 border-b border-slate-50">
                        <th class="px-10 py-6 tracking-[0.1em]">Program Name</th>
                        <th class="px-10 py-6 tracking-[0.1em]">Lead Trainer</th>
                        <th class="px-10 py-6 tracking-[0.1em] text-center">Status</th>
                        <th class="px-10 py-6 tracking-[0.1em] text-right">Control</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($classes ?? [] as $class)
                    <tr class="group hover:bg-rose-50/30 transition-colors">
                        <td class="px-10 py-8">
                            <p class="font-black text-slate-800 uppercase tracking-tighter text-base group-hover:text-lmind-red-mid transition-colors">{{ $class->name }}</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-0.5">Promotion #{{ $class->id }}</p>
                        </td>
                        <td class="px-10 py-8">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-xs font-black uppercase shadow-inner border-b-2 border-slate-700">
                                    {{ substr($class->main_trainer_name ?? '?', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-700">{{ $class->main_trainer_name ?? 'Unassigned' }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Main Trainer</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-8 text-center">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                Active
                            </span>
                        </td>
                        <td class="px-10 py-8 text-right">
                            <a href="{{ url('/admin/classes/' . ($class->id ?? 1) . '/edit') }}" class="inline-flex items-center justify-center bg-lmind-navy text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-lmind-red-mid hover:shadow-lg hover:shadow-rose-900/20 transition-all active:scale-95">
                                Manage Deck
                            </a>
                        </td>
                    </tr>
                    @empty
                    <!-- Mock data for preview if no variables exist -->
                    <tr class="group hover:bg-rose-50/30 transition-colors">
                        <td class="px-10 py-8">
                            <p class="font-black text-slate-800 uppercase tracking-tighter text-base">Web Fullstack Development</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-0.5">Promotion #4</p>
                        </td>
                        <td class="px-10 py-8">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-xs font-black uppercase shadow-inner border-b-2 border-slate-700">JD</div>
                                <div>
                                    <p class="text-sm font-bold text-slate-700">John Doe</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Main Trainer</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-8 text-center">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                Active
                            </span>
                        </td>
                        <td class="px-10 py-8 text-right">
                            <button class="inline-flex items-center justify-center bg-lmind-navy text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-lmind-red-mid hover:shadow-lg hover:shadow-rose-900/20 transition-all active:scale-95">
                                Manage Deck
                            </button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
