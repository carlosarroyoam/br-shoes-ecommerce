@props([
'type' => 'button',
'disabled' => false,
])

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => 'px-6 py-2 text-center text-gray-100 uppercase border-0 rounded bg-primary focus:outline-none hover:shadow-outline active:shadow-outline']) }}
    {{ $disabled ? 'disabled' : '' }}>
    {{ $title }}
</button>
