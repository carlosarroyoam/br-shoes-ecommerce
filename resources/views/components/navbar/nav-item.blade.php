@props(['route'])

@php
$classes = Request::routeIs($route) ? 'text-body' : 'text-body-secondary';
@endphp

<a href="{{ route($route) }}" {{ $attributes->merge([
        'class' => "px-4 py-2 mt-2 text-sm font-medium rounded-sm md:mt-0 hover:text-body {$classes}"
        ]) }}>
    {{ $title }}
</a>
