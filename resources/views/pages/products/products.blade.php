@extends('base.app')

@section('title', __('navigation.products'))

@section('content')
<article>
    <h1 class="text-2xl uppercase text-header">
        {{ __('navigation.products') }}
    </h1>

    @isset($name)
    {{ $name }}
    @endisset
</article>
@endsection
