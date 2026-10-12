<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Comisiones')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="rounded-lg bg-slate-100 p-2">
                    <img src="{{ asset('images/udla.png') }}" alt="Logo UDLA" class="h-8">
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-emerald-600">Kimberly</p>
                    <h1 class="font-bold text-slate-900">Control de comisiones</h1>
                </div>
            </div>
        </div>
    </header>

    <main class="mx-auto mt-6 max-w-6xl px-6">
        @yield('content')
    </main>

    <footer class="mt-12 border-t border-slate-200 py-6 text-center text-sm text-slate-500">
        Proyecto académico &middot; {{ date('Y') }}
    </footer>
</body>
</html>
