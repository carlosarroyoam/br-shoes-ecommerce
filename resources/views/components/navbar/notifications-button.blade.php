<div class="relative" x-data="{ open: false }">
    <button
        {{ $attributes->merge(['class' => 'relative hidden mr-6 text-gray-600 md:block hover:text-gray-800 focus:text-gray-800 focus:outline-none selected:border-gray-800']) }}
        aria-label="Show notifications" x-on:click="open = true">
        <svg class="w-5 h-5 " viewBox="0 0 16 16" class="bi bi-bell" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
            <path fill-rule="evenodd"
                d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
        </svg>

        <span class="absolute top-0 right-0 p-1 text-white rounded-full bg-primary animate-ping"></span>
    </button>

    <div class="absolute right-0 w-64 mt-3 mr-4 overflow-hidden border border-gray-300 rounded-md shadow-md bg-background"
        x-show="open" x-on:click.away="open = false">
        <p class="p-4">
            {{ __('navigation.notifications') }}
        </p>
    </div>
</div>
