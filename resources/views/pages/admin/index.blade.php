<x-admin-layout>
    <h1 class="text-2xl uppercase text-header">{{ __('Dashboard') }}</h1>
    <p class="text-base text-header-secondary">
        {{ __('messages.welcome_back', [ 'name' => Auth::user()->fullName]) }}
    </p>
</x-admin-layout>
