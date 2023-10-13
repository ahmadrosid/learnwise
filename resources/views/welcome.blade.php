<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Learnwise</title>
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
        <main class="layout-main p-5">
            <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @foreach(range(0,9) as $item)
                <div class="col">
                    <div class="card border">
                        <a href=""><img src="/images/d2ebdb09-0a4d-4edf-9681-b0a864f01687-8nhtey.png" class="card-img-top" alt="green iguana" /></a>
                        <div class="card-body p-3">
                            <a href="" class="text-black">
                                <div class="fs-6 fw-bold">Fullstack Notion Clone</div>
                            </a>
                            <div class="fs-sm text-neutral-100">Antonio Erdeljac</div>
                            <div class="hstack gap-2 py-2">
                                <div class="bg-blue-50 p-1 px-2 rounded-circle">
                                    <x-lucide-book-open class="w-4 h-4 text-blue-100" />
                                </div>
                                <span class="text-neutral-100 fs-sm">22 Chapters</span>
                            </div>
                            <div class="fw-bold fs-sm">
                                Free
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>
</body>

</html>