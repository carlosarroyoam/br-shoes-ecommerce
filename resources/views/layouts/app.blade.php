<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow, noarchive">

    <!-- Favicon/App icons -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    <livewire:styles />
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex items-center flex-shrink-0">
                            <a href="/dashboard">
                                <x-jet-application-mark class="block w-auto h-9" />
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-jet-nav-link href="/dashboard" :active="request()->routeIs('dashboard')">
                                Dashboard
                            </x-jet-nav-link>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                    <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                                        alt="" />
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Account
                                </div>

                                <x-jet-dropdown-link href="/user/profile">
                                    Profile
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="/user/api-tokens">
                                    API Tokens
                                </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Management -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="/teams/{{ Auth::user()->currentTeam->id }}">
                                    Team Settings
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="/teams/create">
                                    Create New Team
                                </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                                @endforeach

                                <div class="border-t border-gray-100"></div>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     this.closest('form').submit();">
                                        Logout
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>

                    <!-- Hamburger -->
                    <div class="flex items-center -mr-2 sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-jet-responsive-nav-link href="/dashboard" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-jet-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img class="w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="" />
                        </div>

                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">{{ Auth::user()->getFullNameAttribute() }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="/user/profile" :active="request()->routeIs('profile.show')">
                            Profile
                        </x-jet-responsive-nav-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-responsive-nav-link href="/user/api-tokens"
                            :active="request()->routeIs('api-tokens.index')">
                            API Tokens
                        </x-jet-responsive-nav-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         this.closest('form').submit();">
                                Logout
                            </x-jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Manage Team
                        </div>

                        <!-- Team Settings -->
                        <x-jet-responsive-nav-link href="/teams/{{ Auth::user()->currentTeam->id }}"
                            :active="request()->routeIs('teams.show')">
                            Team Settings
                        </x-jet-responsive-nav-link>

                        <x-jet-responsive-nav-link href="/teams/create" :active="request()->routeIs('teams.create')">
                            Create New Team
                        </x-jet-responsive-nav-link>

                        <div class="border-t border-gray-200"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Switch Teams
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>