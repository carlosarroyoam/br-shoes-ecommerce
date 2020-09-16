<x-app-layout>
    <article>
        <h1 class="text-2xl uppercase text-header">
            {{ __('navigation.products') }}
        </h1>

        @isset($name)
        {{ $name }}
        @endisset
    </article>
</x-app-layout>
