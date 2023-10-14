<div class="layout-sidebar">
    <div class="sidenav show border-end">
        <div class="menu accordion">
            <ul class="menu-list">
                <li>
                    <a class="menu-item p-4 active" href="#">
                        <x-lucide-radar class="w-4 h-4 me-2" />
                        Browse
                    </a>
                </li>
                <li>
                    <a class="menu-item p-4" href="#">
                        <x-lucide-layers-3 class="w-4 h-4 me-2" />
                        My course
                    </a>
                </li>
                <li>
                    <div class="menu-item p-4">
                        <button class="accordion-button p-0 bg-transparent text-reset" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#submenu-1">
                            <x-lucide-bookmark-check class="w-4 h-4 me-2" />
                            Categories
                        </button>
                    </div>
                    <div class="accordion-collapse collapse" id="submenu-1">
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
                <li>
                    <a class="menu-item p-4" href="#">
                        <x-lucide-mail-minus class="w-4 h-4 me-2" />
                        Newsletter
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>