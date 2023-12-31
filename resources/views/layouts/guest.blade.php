<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Learnwise') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="/css/fastbootstrap.min.css">
    <link rel="stylesheet" href="/css/choices.min.css">

    @vite([
    "resources/css/app.css",
    "resources/js/app.js",
    ])
</head>

<body>
    <div class="py-7">
        <div class="container text-center">
            <a href="/">
                <x-application-logo />
            </a>
        </div>

        <div class="w-80 mx-auto">
            <div class="card border">
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    <script src="/js/fastbootstrap.min.js"></script>
</body>

</html>