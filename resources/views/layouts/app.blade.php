<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Search bands, browse genres, and save your favorites with Vibraze.">
    <meta name="theme-color" content="#123d2b">
    <title>@yield('title', 'Vibraze')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ filemtime(public_path('css/styles.css')) }}">
    <script>
        (function () {
            const savedTheme = localStorage.getItem('vibraze-theme');
            const preferredTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            document.documentElement.dataset.theme = savedTheme || preferredTheme;
        })();
    </script>
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>
    @include('layouts.navbar')

    <main id="main-content" class="site-main">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="page-shell footer-inner">
            <a class="brand brand--footer" href="{{ route('home') }}" aria-label="Vibraze home">
                <span class="brand-mark" aria-hidden="true">V</span>
                <span>Vibraze</span>
            </a>
            <p>A place to keep track of bands.</p>
            <p>&copy; {{ date('Y') }} Vibraze</p>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}" defer></script>
</body>
</html>
