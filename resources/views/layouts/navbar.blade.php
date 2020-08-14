<nav class="fixed top-0 w-full bg-gray-100 shadow">
    <div class="container py-3 mx-auto xl:px-6">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-xl font-medium text-gray-800 hover:text-gray-700 md:text-2xl">
                    {{ config('global_constants.app_name', 'BR Shoes') }}
                </a>

                <!-- Mobile menu button -->
                <div class="flex md:hidden">
                    <button type="button"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                        aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div class="flex-1 md:flex md:items-center md:justify-between">
                <div class="flex flex-col md:ml-10 md:flex md:flex-row md:items-center md:justify-start">
                    <x-navbar.nav-item href="{{ route('home') }}">
                        <x-slot name="title">
                            Catalogo
                        </x-slot>
                    </x-navbar.nav-item>

                    <x-navbar.nav-item href="{{ route('home') }}">
                        <x-slot name="title">
                            Lo mas nuevo
                        </x-slot>
                    </x-navbar.nav-item>

                    <x-navbar.nav-item href="{{ route('home') }}">
                        <x-slot name="title">
                            Ofertas
                        </x-slot>
                    </x-navbar.nav-item>
                </div>

                <ul class="flex-1 md:flex md:items-center md:justify-end">
                    <!-- Authentication Links -->
                    <div class="flex flex-col md:flex-row md:items-center">
                        @auth
                        <div class="mt-4 mr-4 md:mt-0" aria-labelledby="">
                            <a class="px-4 py-2 mt-2 text-sm font-medium text-gray-700 rounded-sm md:mt-0 hover:text-gray-600"
                                href="
                                {{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 mt-2 text-sm font-medium text-gray-700 rounded-sm md:mt-0 hover:text-gray-600">{{ __('Login') }}</a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 mt-2 text-sm font-medium text-gray-700 rounded-sm md:mt-0 hover:text-gray-600">{{ __('Register') }}</a>
                        @endauth
                    </div>

                    @auth
                    <div class="flex items-center mt-4 md:mt-0">
                        <x-navbar.notifications-button />

                        <x-navbar.shopping-bag-button />

                        <x-navbar.user-profile-button />
                    </div>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
