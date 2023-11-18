<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="/css/fastbootstrap.min.css">
    <!-- Scripts -->
    @vite([
    "resources/css/app.css",
    "resources/js/app.js",
    ])
</head>

<body>
    @include('layouts.navigations.coursenav', ["title" => $title])

    <div class="layout">
        {{ $slot }}
    </div>
    <script src="/js/fastbootstrap.min.js"></script>
</body>

</html>