<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo')
    <link rel="preload" as="image" href="{{ asset('images/mascot-pantau-jentik.webp') }}?v=2" fetchpriority="high">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    <a href="#konten" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-white focus:px-4 focus:py-2">Lewati ke konten</a>
    @include('partials.header')
    <main id="konten">
        @yield('content')
    </main>
    @include('partials.footer')
    @include('partials.mascot-widget')
</body>
</html>
