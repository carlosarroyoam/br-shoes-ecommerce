@props([
'name',
'label',
])

<div {{ $attributes }}>
    <div class="flex items-center">
        <input id="{{ $name }}" type="checkbox" name="{{ $name }}" class="" {{ old($name) ? 'checked' : '' }}>

        @if($label ?? false)
        <label class="ml-2 text-sm uppercase text-body-secondary" for="{{ $name }}">
            {{ $label }}
        </label>
        @endif

    </div>
</div>
