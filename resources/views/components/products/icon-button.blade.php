@props([
'onClickAction' => '',
'ariaLabel' => '',
'disabled' => false,
])

<button
    {{ $attributes->merge(['class' => 'absolute bottom-0 right-0 mb-4 text-gray-600 md:block hover:text-gray-800 focus:text-gray-800 focus:outline-none selected:border-gray-800']) }}
    aria-label="{{ $ariaLabel }}" wire:click.prevent="{{ $onClickAction }}">
    <svg class="w-5 h-5 fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
        {{ $svgPath }}
    </svg>
</button>
