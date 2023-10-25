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


    @vite(['node_modules/fastbootstrap/dist/css/fastbootstrap.min.css', 'resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center" style="font-size: 18px; text-transform: uppercase;">
            Course not found!
        </div>
    </div>
</body>

</html>
