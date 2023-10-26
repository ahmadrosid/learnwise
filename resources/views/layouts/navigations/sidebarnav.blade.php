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
                    <a class="menu-item p-4 active" href="#">
                        <x-lucide-radar class="w-5 h-5 me-2" />
                        Browse
                    </a>
                </li>
                <li>
                    <a class="menu-item p-4" href="/courses/mycourses">
                        <x-lucide-layers-3 class="w-5 h-5 me-2" />
                        My learning
                    </a>
                </li>
                <li>
                    <div class="menu-item p-4">
                        <button class="accordion-button p-0 bg-transparent text-reset" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#categories">
                            <x-lucide-bookmark-check class="w-5 h-5 me-2" />
                            Categories
                        </button>
                    </div>
                    <div class="accordion-collapse collapse" id="categories">
                        <ul class="menu-list">
                            <li>
                                <a class="menu-item py-3" href="#">Frontend</a>
                            </li>
                            <li>
                                <a class="menu-item py-3" href="#">Backend</a>
                            </li>
                            <li>
                                <a class="menu-item py-3" href="#">Fullstack</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if(Auth::check() && Auth::user()->hasRole("teacher"))
                <li>
                    <a class="menu-item p-4" href="/teacher">
                        <x-lucide-graduation-cap class="w-5 h-5 me-2" />
                        Teach
                    </a>
                </li>
                @else
                <li>
                    <a class="menu-item p-4" href="/teacher/signup">
                        <x-lucide-graduation-cap class="w-5 h-5 me-2" />
                        Teach on Learnwise
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>