@extends('base.app')

@section('title', __('Home'))

@section('content')
<article>
    <livewire:products-list title="Todos los productos" />
</article>
@endsection
