@props([
'name' => '',
'label' => '',
])

<div {{ $attributes }}>
    <div class="flex items-center">
        <input class="" type="checkbox" name="{{ $name }}" id="{{ $name }}" {{ old($name) ? 'checked' : '' }}>

        <label class="ml-2 text-sm uppercase text-body-secondary" for="{{ $name }}">
            {{ $label }}
        </label>
    </div>
</div>
