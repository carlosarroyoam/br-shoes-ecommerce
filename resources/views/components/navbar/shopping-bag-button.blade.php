<div class="relative" x-data="{ open: false }">
    <button
        {{ $attributes->merge(['class' => 'relative hidden mr-6 text-gray-600 md:block hover:text-gray-800 focus:text-gray-800 focus:outline-none selected:border-gray-800']) }}
        aria-label="Show notifications" x-on:click="open = true">
        <svg class="w-5 h-5" viewBox="0 0 16 16" class="bi bi-bag" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z" />
            <path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z" />
        </svg>
    </button>

    <div class="absolute right-0 w-64 mt-3 mr-4 overflow-hidden bg-gray-100 border border-gray-300 rounded-md shadow-md"
        x-show="open" x-on:click.away="open = false">
        {{ __('navigation.bag') }}
    </div>
</div>
