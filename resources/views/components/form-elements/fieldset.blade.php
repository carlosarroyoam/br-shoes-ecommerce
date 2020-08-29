<fieldset {{ $attributes }}>

    @if($legend ?? false)
    <legend class="text-sm uppercase text-header">
        {{ $legend }}
    </legend>
    @endif

    {{ $slot }}

</fieldset>
