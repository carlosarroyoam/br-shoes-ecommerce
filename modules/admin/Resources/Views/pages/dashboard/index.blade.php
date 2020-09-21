<x-dashboard-layout>
    <h1 class="text-2xl uppercase text-header">{{ __('Dashboard') }}</h1>
    <p class="text-base text-header-secondary">
        {{ __('messages.welcome_back', [ 'name' => Auth::user()->full_name]) }}
    </p>

    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="block p-4 text-sm hover:text-gray-100 hover:bg-primary">
        {{ __('Logout') }}
    </a>
    <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
</x-dashboard-layout>
