<nav class="navbar navbar-expand-lg header-navbar py-0 sticky-top bg-white">
    <div style='width:256px;' class="border-end py-3 px-2">
        <a class="navbar-brand fw-bold" href="/" style="font-size: 16px;">
            <img src="/images/learnwise.svg" width="36" alt="Logo" /> Learnwise
        </a>
    </div>
    <div class="flex-fill px-5 fw-bold">
        {{ $title }}
    </div>
    <div class="px-4">
        @if(!Auth::user())
        <a href="{{ route('login') }}">
            <button class="btn btn-primary">
                Login
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                    <polyline points="10 17 15 12 10 7" />
                    <line x1="15" x2="3" y1="12" y2="12" />
                </svg>
            </button>
        </a>
        @else

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                <button class="btn btn-primary">{{ __('Log Out') }}</button>
            </x-responsive-nav-link>
        </form>
        @endif
    </div>
</nav>