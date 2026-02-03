<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <title>LMind - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex flex-col h-full">

    @include('partials.header')
    <div class="flex flex-1">
        <aside class="w-64 bg-white border-r p-6 hidden md:block">
            <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Main Menu</h4>
            <nav class="space-y-1">
                <a href="#"
                    class="block px-3 py-2 rounded-md bg-indigo-50 text-indigo-700 font-medium">Dashboard</a>
                @if (Auth::user()->role->name === 'TRAINER')
                    <a href="#" class="block px-3 py-2 rounded-md text-gray-600 hover:bg-gray-50">Manage
                        Briefs</a>
                @endif
            </nav>
        </aside>

        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

    @include('partials.footer')
</body>

</html>
