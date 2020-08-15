<footer class="text-gray-700 bg-gray-100 body-font footer">
    {{-- Upper footer section --}}
    <div class="container flex flex-wrap order-first py-16 text-center md:text-left">
        {{-- Categories section --}}
        <div class="w-full lg:w-1/4 md:w-1/2">
            <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 uppercase title-font">CATEGORIES</h2>
            <nav class="mb-10 list-none md:mb-0">
                <li>
                    <a class="text-gray-600 hover:text-gray-800">First Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                </li>
            </nav>
        </div>

        {{-- Navigation section --}}
        <div class="w-full lg:w-1/4 md:w-1/2">
            <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 uppercase title-font">Navigation</h2>
            <nav class="mb-10 list-none md:mb-0">
                <li>
                    <a class="text-gray-600 hover:text-gray-800">First Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                </li>
            </nav>
        </div>

        {{-- Categories section --}}
        <div class="w-full lg:w-1/4 md:w-1/2">
            <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 uppercase title-font">CATEGORIES</h2>
            <nav class="mb-10 list-none md:mb-0">
                <li>
                    <a class="text-gray-600 hover:text-gray-800">First Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Second Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                </li>
            </nav>
        </div>

        {{-- Newsletter section --}}
        <div class="w-full lg:w-1/4 md:w-1/2">
            <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 title-font">SUBSCRIBE</h2>
            <div class="flex flex-wrap justify-center xl:flex-no-wrap md:flex-no-wrap lg:flex-wrap md:justify-start">
                <input
                    class="px-4 py-2 mr-2 text-base bg-gray-100 border border-gray-400 rounded sm:w-auto xl:mr-4 lg:mr-0 sm:mr-4 focus:outline-none focus:border-indigo-500"
                    placeholder="Placeholder" type="text">
                <x-button>
                    <x-slot name="title">
                        SUBSCRIBE
                    </x-slot>
                </x-button>
            </div>
            <p class="mt-2 text-sm text-center text-gray-500 md:text-left">Bitters chicharrones fanny pack
                <br class="hidden lg:block">waistcoat green juice
            </p>
        </div>

    </div>

    {{-- Lower footer section --}}
    <div class="bg-gray-200">
        <div class="container flex flex-col items-center py-6 sm:flex-row">
            <a href="{{ route('home') }}"
                class="flex flex-col items-start justify-center text-gray-800 uppercase md:justify-start">
                <span class="text-xl font-medium">
                    {{ config('global_constants.app_name', 'BR Shoes') }}
                </span>
                <span class="text-xs text-gray-500">
                    {{ config('global_constants.slogan', 'Ama tu estilo') }}
                </span>
            </a>

            <p class="mt-4 text-sm text-gray-500 sm:ml-8 sm:mt-0">
                © {{ now()->year }}
                {{ config('global_constants.app_name', 'BR Shoes') }}
                —
                {{ __('All rights reserved.') }}
            </p>

            <span class="inline-flex justify-center mt-4 sm:ml-auto sm:mt-0 sm:justify-start">
                <a class="mr-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="mr-3 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="text-gray-500">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                        <path stroke="none"
                            d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                        </path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </span>
        </div>
    </div>
</footer>
