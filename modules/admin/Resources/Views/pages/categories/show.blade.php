<x-app-layout>
    <article>
        <h1 class="text-2xl uppercase text-header">
            {{ __('navigation.categories') }}
        </h1>

        <p>{{ $category->name }}</p>
        <p>{{ $category->slug }}</p>
    </article>
</x-app-layout>
