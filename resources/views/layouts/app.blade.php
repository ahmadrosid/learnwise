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
    "resources/css/app.css",
    "resources/js/app.js",
    ])
</head>

<body>
    @include('layouts.navigation')


    <div class="layout">
        <div class="layout-sidebar">
            <div class="sidenav show border-end">
                <div class="sidenav-body">
                    <div class="menu accordion">
                        <ul class="menu-list">
                            <li>
                                <a class="menu-item active" href="#">Browse</a>
                            </li>
                            <li>
                                <a class="menu-item" href="#">Discord</a>
                            </li>
                            <li>
                                <div class="menu-item">
                                    <button class="accordion-button p-0 bg-transparent text-reset" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#submenu-1">Categories</button>
                                </div>
                                <div class="accordion-collapse collapse" id="submenu-1">
                                    <ul class="menu-list">
                                        <li>
                                            <a class="menu-item" href="#">Frontend</a>
                                        </li>
                                        <li>
                                            <a class="menu-item" href="#">Backend</a>
                                        </li>
                                        <li>
                                            <a class="menu-item" href="#">Fullstack</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a class="menu-item" href="#">Newsletter</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <main class="p-5">
            {{ $slot }}
        </main>
    </div>
</body>

</html>