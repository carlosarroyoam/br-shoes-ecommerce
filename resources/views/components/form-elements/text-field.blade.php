@props([
'name' => '',
'label' => '',
'placeholder' => '',
'type' => 'text',
'autocomplete' => 'off',
'autofocus' => false,
'required' => false,
])

<div {{ $attributes }}>
    @if($label ?? null)
    <label for="{{ $name }}" class="text-sm uppercase text-body-secondary">{{ $label }}</label>
    @endif

    <div class="flex flex-col">
        <input id="{{ $name }}"
            class="px-3 py-2 border border-gray-400 rounded-md outline-none focus:shadow-outline @error('{{ $name }}')  @enderror"
            type="{{ $type }}" name="{{ $name }}" value="{{ old($name) }}" placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}" {{ $autofocus ? 'autofocus' : '' }} {{ $required ? 'required' : '' }}>

        @error($name)
        <span class="mt-2 text-xs text-red-600 uppercase" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
