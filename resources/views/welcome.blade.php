<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Laravel + Vue</title>
    @if (app()->environment('testing'))
        
    @else
        @vite(['resources/css/app.css','resources/js/app.ts'])
    @endif
    <script>
      (function () {
        const saved = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const isDark = saved ? saved === 'dark' : prefersDark;
        document.documentElement.classList.toggle('dark', isDark);
      })();
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body>
<div id="app-root" class="min-h-screen flex flex-col bg-bg text-fg"></div>
</body>
</html>
