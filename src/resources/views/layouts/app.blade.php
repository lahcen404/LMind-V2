<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMind - @yield('title', 'Learning Management')</title>

    <!-- Tailwind CSS with Custom Palette Configuration -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lmind-navy': '#0f172a',
                        'lmind-navy-light': '#1e293b',
                        'lmind-red-light': '#f43f5e',
                        'lmind-red-mid': '#be123c',
                        'lmind-red-dark': '#881337',
                    },
                    borderRadius: {
                        '4xl': '2rem',
                    }
                }
            }
        }
    </script>

    <!-- Typography & Smooth Scrolling -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }

        /* Glassmorphism effects */
        .glass-nav {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 h-full flex flex-col overflow-hidden antialiased">

    <!-- Top Navigation (Header) -->
    @include('partials.header')

    <div class="flex flex-1 overflow-hidden relative">

        <!-- Sidebar Navigation -->
        @include('partials.sidebare')

        <!-- Main Workspace -->
        <main class="flex-1 flex flex-col relative overflow-hidden">

            <!-- Dynamic Page Content -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-4 md:p-8 lg:p-10">
                <div class="max-w-7xl mx-auto space-y-8">

                    <!-- Flash Messaging System -->
                    @if(session('success'))
                        <div class="flex items-center gap-4 bg-emerald-50 border border-emerald-100 p-4 rounded-2xl shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
                            <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <p class="text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="flex items-center gap-4 bg-rose-50 border border-rose-100 p-4 rounded-2xl shadow-sm">
                            <div class="w-8 h-8 rounded-full bg-lmind-red-light flex items-center justify-center text-white shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                            <p class="text-sm font-semibold text-rose-800">{{ session('error') }}</p>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>

            @include('partials.footer')

        </main>
    </div>

    <!-- UI Interaction Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            console.log('LMind Layout Initialized');
        });
    </script>

</body>
</html>
