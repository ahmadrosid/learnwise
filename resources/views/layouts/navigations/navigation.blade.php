<nav class="navbar navbar-expand-lg header-navbar py-0 sticky-top bg-white" style="height: 60px">
    <div class="flex-fill">
        <form class="px-4 max-w-xs">
            <input type="text" class="form-control form-control-sm" placeholder="Search" />
        </form>
    </div>
    <div class="px-4">
        @if(!Auth::user())
        <a href="{{ route('login') }}" class="btn px-2">
            <button class="btn btn-outline-primary">
                Login
            </button>
        </a>
        <a href="{{ route('register') }}">
            <button class="btn btn-primary">
                Register
            </button>
        </a>
        @else

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                <button class="btn btn-outline-primary">{{ __('Log Out') }}</button>
            </x-responsive-nav-link>
        </form>
        @endif
    </div>
</nav>