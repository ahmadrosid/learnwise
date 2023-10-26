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
                        Teaching
                    </a>
                </li>
                @endif
                @if(Auth::check())
                <li>
                    <a class="menu-item p-4" href="{{route('profile.edit')}}">
                        <x-lucide-user class="w-5 h-5 me-2" />
                        Profile
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>