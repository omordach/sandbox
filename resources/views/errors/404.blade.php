<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 — Not Found</title>
  @vite(['resources/css/app.css'])
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
  <main class="container-page min-h-screen flex items-center">
    <section class="mx-auto max-w-lg text-center">
      <h1 class="text-5xl font-bold tracking-tight">404</h1>
      <p class="mt-2 text-[hsl(var(--muted))]">Sorry, we couldn’t find that page.</p>
      <div class="mt-6">
        <a href="/" class="btn-primary">Go home</a>
      </div>
    </section>
  </main>
</body>
</html>

