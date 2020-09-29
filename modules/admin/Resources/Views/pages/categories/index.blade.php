<x-app-layout>
    <article>
        <h1 class="text-2xl uppercase text-header">
            {{ __('navigation.categories') }}
        </h1>

        @foreach ($categories as $category)
        <p>{{ $category->name }}</p>
        <p>{{ $category->slug }}</p>
        @endforeach
    </article>
</x-app-layout>
