<div class="layout-sidebar">
    <div class="sidenav show border-end">
        <div class="menu accordion">
            <ul class="menu-list">
                <li class="position-sticky">
                    <div class="py-3 px-2 brand">
                        <a class="navbar-brand fw-bold" href="/">
                            <img src="/images/learnwise.svg" width="36" alt="Logo" /> {{ config('app.name') }}
                        </a>
                    </div>
                </li>


                <li>
                    <a class="p-4 menu-item{{ Request::is('/') ? ' active' : '' }}" href="/">
                        <x-lucide-radar class="w-5 h-5 me-2" />
                        Browse
                    </a>
                </li>
                <li>
                    <a class="p-4 menu-item{{ Request::is('course/mycourses') ? ' active' : '' }}"
                        href="/course/mycourses">
                        <x-lucide-layers-3 class="w-5 h-5 me-2" />
                        My learning
                    </a>
                </li>
                @if (Auth::check() && Auth::user()->hasRole('teacher'))
                    <li>
                        <a class="p-4 menu-item" href="/teacher">
                            <x-lucide-graduation-cap class="w-5 h-5 me-2" />
                            Teacher dashboard
                        </a>
                    </li>
                @elseif(Auth::check() && !Auth::user()->hasRole('teacher'))
                    <li>
                        <a class="p-4 menu-item{{ Request::is('student/purchases') ? ' active' : '' }}"
                            href="/student/purchases">
                            <x-lucide-shopping-cart class="w-5 h-5 me-2" />
                            My purchases
                        </a>
                    </li>
                @elseif(!Auth::check() && env('ALLOW_TEACHER_REGISTRATION'))
                    <li>
                        <a class="p-4 menu-item" href="/teacher/signup">
                            <x-lucide-graduation-cap class="w-5 h-5 me-2" />
                            Become a teacher
                        </a>
                    </li>
                @endif
                @if (Auth::check())
                    <li>
                        <a class="p-4 menu-item{{ Request::is('profile') ? ' active' : '' }}"
                            href="{{ route('profile.edit') }}">
                            <x-lucide-user class="w-5 h-5 me-2" />
                            Profile
                        </a>
                    </li>
                @endif

                @if (Auth::check() && auth()->user()->role === 'admin')
                    <li>

                        <a class="p-4 menu-item" href="{{ route('admin') }}">
                            <x-lucide-user-cog class="w-5 h-5 me-2" />
                            Admin
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
