<form wire:submit.prevent="submit">
    <div class="relative inline-block">
        <input class="px-3 py-2 border border-gray-400 rounded-md outline-none focus:shadow-outline focus:bg-blue-100"
            type="text" wire:model="query" placeholder="{{ __('Search something...') }}">

        <button class="absolute top-0 bottom-0 right-0 mr-3 text-gray-700 focus:outline-none" type="submit">
            <svg class="w-5 h-5" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                <path fill-rule="evenodd"
                    d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
            </svg>
        </button>
    </div>
</form>
