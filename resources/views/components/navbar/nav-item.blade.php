@props(['route'])

@php
$classes = Request::routeIs($route) ? 'text-body' : 'text-body-secondary';
@endphp

<li {{ $attributes->merge([
    'class' => "flex flex-row {$classes}"
    ]) }}>

    <a href="{{ route($route) }}"
        class="w-full px-4 py-2 mt-2 text-sm font-medium rounded-sm lg:mt-0 focus:outline-none focus:shadow-outline focus:text-body hover:text-body">
        {{ $title }}
    </a>

</li>
