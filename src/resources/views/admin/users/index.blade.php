@extends('layouts.app')
@section('title', 'User Management')
@section('content')
    <!-- Header Area -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div>
            <span class="text-[10px] font-black text-lmind-red-mid uppercase tracking-[0.4em] mb-2 block">System
                Administration</span>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic">Manage <span
                    class="text-lmind-red-light">Personnel</span></h1>
        </div><a href="{{ route('admin.users.create') }}"
            class="bg-lmind-navy text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-lmind-red-mid transition-all shadow-xl shadow-slate-900/10 active:scale-95 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
            </svg>
            Register New User
        </a>
    </div><!-- Search & Filter Bar -->
    <div class="bg-white p-4 rounded-[2rem] shadow-sm border border-slate-100 mb-8 flex flex-col md:flex-row gap-4">
        <div class="flex-1 relative"><svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg><input type="text" placeholder="Search by name, email or ID..."
                class="w-full bg-slate-50 border-none rounded-xl py-3 pl-12 pr-4 text-sm focus:ring-2 focus:ring-lmind-red-light transition">
        </div><select
            class="bg-slate-50 border-none rounded-xl py-3 px-6 text-sm font-bold text-slate-500 focus:ring-2 focus:ring-lmind-red-light">
            <option>All Roles</option>
            <option>Admins</option>
            <option>Trainers</option>
            <option>Learners</option>
        </select>
    </div><!-- Users Table -->
    <div class="bg-lmind-navy rounded-[2.5rem] p-2 shadow-2xl overflow-hidden">
        <div class="bg-white rounded-[2.2rem] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] uppercase font-black text-slate-400 bg-slate-50/50 border-b border-slate-50">
                            <th class="px-10 py-6">User Identity</th>
                            <th class="px-10 py-6">Role / Level</th>
                            <th class="px-10 py-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($users as $user)
                            <tr class="group hover:bg-rose-50/30 transition-colors">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-lmind-navy text-white flex items-center justify-center font-black text-xs shadow-inner">
                                            {{ substr($user->full_name, 0, 1) }}</div>
                                        <div>
                                            <p class="font-black text-slate-800 uppercase tracking-tight">
                                                {{ $user->full_name }}</p>
                                            <p class="text-[10px] text-slate-400 font-bold tracking-widest">
                                                {{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-6"><span
                                        class="px-3 py-1 rounded-lg bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-widest border border-slate-200">{{ $user->role->name ?? $user->role }}</span>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <div class="flex justify-end items-center gap-2"><!-- EDIT ACTION --><a
                                            href="{{ route('admin.users.edit', $user->id) }}"class="p-2 text-slate-400 hover:text-lmind-red-mid transition transform hover:scale-110"
                                            title="Edit User"><svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg></a> <!-- DELETE ACTION -->
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this user? ');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-slate-400 hover:text-lmind-red-dark transition transform hover:scale-110"
                                                title="Delete User">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-10 py-12 text-center text-slate-400 italic">
                                    No users found in the system.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</div>@endsection
