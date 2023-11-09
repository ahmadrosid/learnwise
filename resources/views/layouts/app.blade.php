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

    <!-- Scripts -->
    @vite([
    "public/css/fastbootstrap.min.css",
    "resources/css/app.css",
    "resources/js/app.js",
    ])
</head>

<body>
    <div class="layout">
        @include('layouts.navigations.sidebarnav')
        <div>
            @include('layouts.navigations.navigation')
            <main class="p-5 bg-neutral-10">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>