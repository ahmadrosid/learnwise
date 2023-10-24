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
    "node_modules/fastbootstrap/dist/css/fastbootstrap.min.css",
    "node_modules/choices.js/public/assets/styles/choices.min.css",
    "resources/css/app.css",
    "resources/js/app.js",
    ])
</head>

<body>
    <div class="layout">
        <div class="layout-sidebar">
            <div class="sidenav show border-end">
                <div class="menu accordion">
                    <ul class="menu-list">
                        <li class="position-sticky">
                            <div class="brand py-3 px-2">
                                <a class="navbar-brand fw-bold" href="/">
                                    <img src="/images/learnwise.svg" width="36" alt="Logo" /> Learnwise
                                </a>
                            </div>
                        </li>
                        <li>
                            <a class="menu-item p-4 {{ request()->is('teacher') ? 'active' : '' }}" href="/teacher">
                                <x-lucide-list class="w-4 h-4 me-2" />
                                Courses
                            </a>
                        </li>
                        <li>
                            <a class="menu-item p-4 {{ request()->is('teacher/analytics') ? 'active' : '' }}" href="/teacher/analytics">
                                <x-lucide-bar-chart class="w-4 h-4 me-2" />
                                Analytics
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div>
            @include('layouts.navigations.teachernav')
            <main style="min-height: 90vh;">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
