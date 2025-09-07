<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Oleh Mordach — Certifications')</title>
    <meta name="description" content="@yield('meta_description', 'Certifications and profile of Oleh Mordach.')">
    @if (app()->environment('testing'))
        
    @else
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
    @endif
    <script>
        (function () {
            const saved = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = saved ? saved === 'dark' : prefersDark;
            document.documentElement.classList.toggle('dark', isDark);
        })();
    </script>
</head>
<body>
<div id="app">
    <header class="border-b border-[hsl(var(--border))] bg-[hsl(var(--surface-1))]">
        <div class="container-page h-16 flex items-center justify-between">
            <a href="/" class="font-semibold">{{ config('profile.name', config('app.name')) }}</a>
            <nav class="flex items-center gap-4 text-sm">
                <a href="/certifications" class="btn-ghost">Certifications</a>
                <theme-toggle aria-label="Toggle theme"></theme-toggle>
            </nav>
        </div>
    </header>

    <main class="container-page py-8">
        @yield('content')
    </main>

    <footer class="border-t border-[hsl(var(--border))] bg-[hsl(var(--surface-1))]">
        <div class="container-page h-16 flex items-center justify-between text-sm text-[hsl(var(--muted))]">
            © {{ date('Y') }} {{ config('profile.name', 'Oleh Mordach') }}
        </div>
    </footer>
</div>
</body>
</html>
