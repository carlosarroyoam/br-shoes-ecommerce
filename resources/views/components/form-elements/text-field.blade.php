@props([
'name' => 'no-name',
'label',
'placeholder',
'type' => 'text',
'autocomplete' => 'off',
'autofocus' => false,
'required' => false,
'withRequiredIndicator' => false,
])

<div {{ $attributes }}>
    <div class="flex flex-row justify-between">
        @if($label ?? false)
        <label for="{{ $name }}" class="mb-2 ml-1 text-sm capitalize text-body-secondary">{{ $label }}</label>
        @endif

        @if($required && $withRequiredIndicator)
        <span class="mb-2 mr-2 text-red-600 capitalize">*</span>
        @endif
    </div>

    <div class="flex flex-col">
        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}"
            class="px-3 py-2 border border-gray-400 rounded-md outline-none focus:shadow-outline @error($name) border-red-600 @enderror"
            @if(old($name) ?? false) value="{{ old($name) }}" @endif @if($placeholder ?? false)
            placeholder="{{ $placeholder ?? '' }}" @endif autocomplete="{{ $autocomplete }}"
            {{ $autofocus ? 'autofocus' : '' }} {{ $required ? 'required' : '' }}>

        @error($name)
        <span class="mt-2 text-xs text-red-600 uppercase" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
