<div class="relative" x-data="{ open: false }">
    <button
        {{ $attributes->merge(['class' => 'block flex items-center w-8 h-8 overflow-hidden border-2 border-gray-600 rounded-full focus:outline-none focus:border-gray-700 hover:border-gray-700 selected:border-gray-700']) }}
        type="button" aria-label="toggle profile dropdown" x-on:click="open = true">
        <img src="https://avatars0.githubusercontent.com/u/43684710?s=460&u=cf39559f8f973dcc3f83966d91bcdcf17624d1c1&v=4"
            class="object-cover w-full h-full" alt="{{ __('User profile picture') }}">
    </button>

    <div class="absolute right-0 w-64 mt-2 overflow-hidden bg-gray-100 border border-gray-300 rounded-md shadow-md"
        x-show="open" x-on:click.away="open = false">
        <a href="#" class="block p-4 text-sm hover:text-gray-100 hover:bg-blue-900">
            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </a>
        <a href="#" class="block p-4 text-sm hover:text-gray-100 hover:bg-blue-900">
            {{ __('Shopping Bag') }}
        </a>
        <a href="#" class="block p-4 text-sm hover:text-gray-100 hover:bg-blue-900">
            {{ __('Settings') }}
        </a>
    </div>
</div>
