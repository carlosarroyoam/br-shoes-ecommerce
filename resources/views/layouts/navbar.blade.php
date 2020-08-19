<header class="fixed top-0 z-50 w-full py-3 border-b-2 shadow bg-background border-primary">
    <div class="container md:flex md:items-center md:justify-between" x-data="{ open: false }">
        <div class="flex items-center justify-between ">
            <a href=" {{ route('home') }}"
                class="text-xl font-medium uppercase text-header-secondary hover:text-header focus:outline-none focus:text-body md:text-2xl">
                {{ config('global_constants.app_name', 'BR Shoes') }}
            </a>

            <!-- Mobile menu button -->
            <div class="flex md:hidden">
                <button type="button" class="text-body-secondary hover:text-body focus:outline-none focus:text-body"
                    aria-label="toggle menu" x-on:click="open = true">
                    <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                        <path fill-rule="evenodd"
                            d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div class="flex-1 md:flex md:items-center md:justify-between" x-bind:class="{ 'block': open, 'hidden': !open }"
            x-on:click.away="open = false">
            <nav class="flex flex-col md:ml-10 md:flex md:flex-row md:items-center">
                <x-navbar.nav-item route="home">
                    <x-slot name="title">
                        Catalogo
                    </x-slot>
                </x-navbar.nav-item>

                <x-navbar.nav-item route="home">
                    <x-slot name="title">
                        Lo mas nuevo
                    </x-slot>
                </x-navbar.nav-item>

                <x-navbar.nav-item route="home">
                    <x-slot name="title">
                        Ofertas
                    </x-slot>
                </x-navbar.nav-item>
            </nav>

            <div class="flex-1 md:flex md:items-center md:justify-end">
                <!-- Authentication Links -->
                @guest
                <div class="flex flex-col md:flex-row md:items-center">
                    <x-navbar.nav-item route="login">
                        <x-slot name="title">
                            {{ __('Login') }}
                        </x-slot>
                    </x-navbar.nav-item>

                    <x-navbar.nav-item route="register">
                        <x-slot name="title">
                            {{ __('Register') }}
                        </x-slot>
                    </x-navbar.nav-item>
                </div>
                @else
                <div class="flex items-center mt-4 md:mt-0">
                    <x-navbar.notifications-button />

                    <x-navbar.shopping-bag-button />

                    <x-navbar.user-profile-button />
                </div>
                @endauth
            </div>
        </div>
    </div>
</header>
