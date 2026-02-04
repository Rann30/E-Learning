<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Dashboard Guru')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen">


    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg min-h-screen">
            <div class="p-6 border-b">
                <h1 class="text-lg font-bold text-slate-800">Panel Guru</h1>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('teacher.dashboard') }}" class="block px-4 py-2 rounded hover:bg-emerald-100">Dashboard</a>
                <a href="{{ route('teacher.assignments.index') }}" class="block px-4 py-2 rounded hover:bg-emerald-100">Tugas</a>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600">Logout</button>
                </form>
            </nav>
        </aside>


        <!-- Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>


</body>

</html>