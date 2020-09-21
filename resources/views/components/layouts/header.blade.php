<header class="fixed top-0 z-50 w-full py-3 border-b-2 shadow bg-background border-primary">
    <div class="container lg:flex lg:items-center lg:justify-between" x-data="{ open: false }">
        <div class="flex items-center justify-between ">
            <a href=" {{ route('home') }}"
                class="px-4 py-2 text-xl font-medium uppercase rounded-sm text-header-secondary hover:text-header focus:outline-none focus:shadow-outline focus:text-body md:text-2xl">
                {{ config('global_constants.app_name', 'BR Shoes') }}
            </a>

            {{-- Mobile menu button --}}
            <div class="flex lg:hidden">
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

        {{-- Mobile Menu open: "block", Menu closed: "hidden" --}}
        <nav class="flex-1 lg:flex lg:items-center lg:justify-between" x-bind:class="{ 'block': open, 'hidden': !open }"
            x-on:click.away="open = false">
            {{-- Navigation Links --}}
            <ul class="flex flex-col list-none lg:ml-10 lg:flex lg:flex-row lg:items-center">
                <x-navbar.categories-dropdown>
                    <x-slot name="title">
                        Categorías
                    </x-slot>
                </x-navbar.categories-dropdown>

                <x-navbar.nav-item route="products.index">
                    <x-slot name="title">
                        Productos
                    </x-slot>
                </x-navbar.nav-item>

                <x-navbar.nav-item route="products.newest">
                    <x-slot name="title">
                        Lo más nuevo
                    </x-slot>
                </x-navbar.nav-item>

                <x-navbar.nav-item route="products.offers">
                    <x-slot name="title">
                        Ofertas
                    </x-slot>
                </x-navbar.nav-item>
            </ul>

            <div class="flex-1 lg:flex lg:items-center lg:justify-end">
                {{-- Guest Links --}}
                @guest
                <ul class="flex flex-col list-none lg:flex-row lg:items-center">
                    <x-navbar.nav-item route="login">
                        <x-slot name="title">
                            {{ __('Login') }}
                        </x-slot>
                    </x-navbar.nav-item>

                    <x-navbar.nav-item route="register" class="-mr-4">
                        <x-slot name="title">
                            {{ __('Register') }}
                        </x-slot>
                    </x-navbar.nav-item>
                </ul>
                @endguest

                {{-- Authentication Links --}}
                @admin
                <div class="flex items-center mt-4 md:mt-0">
                    <x-navbar.nav-item route="admin.dashboard" class="-mr-4">
                        <x-slot name="title">
                            {{ __('Dashboard') }}
                        </x-slot>
                    </x-navbar.nav-item>
                </div>
                @endadmin

                @customer
                <div class="flex items-center mt-4 md:mt-0">
                    <livewire:navbar.notifications-button />

                    <livewire:navbar.shopping-bag-button />

                    <x-navbar.user-profile-button />
                </div>
                @endcustomer
            </div>
        </nav>
    </div>
</header>
