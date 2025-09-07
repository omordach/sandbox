<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Oleh Mordach — Certifications')</title>
    <meta name="description" content="@yield('meta_description', 'Certifications and profile of Oleh Mordach.')">
    @if (!app()->environment('testing') && file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
    @endif
</head>
<body class="bg-gray-50 text-gray-900">
<div id="app">
    <header class="border-b bg-white">
        <div class="container mx-auto max-w-5xl px-4 py-4 flex items-center justify-between">
            <a href="/" class="font-semibold">{{ config('profile.name', config('app.name')) }}</a>
            <nav class="text-sm">
                <a href="/certifications" class="text-blue-600 hover:underline">Certifications</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto max-w-5xl px-4 py-8">
        @yield('content')
    </main>

    <footer class="border-t bg-white">
        <div class="container mx-auto max-w-5xl px-4 py-6 text-sm text-gray-500">
            © {{ date('Y') }} {{ config('profile.name', 'Oleh Mordach') }}
        </div>
    </footer>
</div>
</body>
</html>
