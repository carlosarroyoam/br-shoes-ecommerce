<div class="relative" x-data="{ open: false }">
    <button
        {{ $attributes->merge(['class' => 'block flex items-center w-8 h-8 overflow-hidden border-2 border-gray-500 rounded-full focus:outline-none focus:border-gray-600 hover:border-gray-600 selected:border-gray-600']) }}
        type="button" aria-label="toggle profile dropdown" x-on:click="open = true">
        <img src="https://avatars0.githubusercontent.com/u/43684710?s=460&u=cf39559f8f973dcc3f83966d91bcdcf17624d1c1&v=4"
            class="object-cover w-full h-full" alt="{{ __('User profile picture') }}">
    </button>

    <div class="absolute right-0 w-64 mt-2 overflow-hidden border border-gray-300 rounded-md shadow-md bg-background"
        x-show="open" x-on:click.away="open = false">
        <a href="#" class="block p-4 text-sm hover:text-gray-100 hover:bg-primary">
            {{ Auth::user()->fullName }}
        </a>
        <a href="#" class="block p-4 text-sm hover:text-gray-100 hover:bg-primary">
            {{ __('Shopping Bag') }}
        </a>
        <a href="#" class="block p-4 text-sm hover:text-gray-100 hover:bg-primary">
            {{ __('Settings') }}
        </a>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="block p-4 text-sm hover:text-gray-100 hover:bg-primary">
            {{ __('Logout') }}
        </a>
        <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </div>
</div>
