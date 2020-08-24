@extends('base.app')

@section('title', __('Home'))

@section('content')

<article>
    <h1 class="text-2xl uppercase text-header">Todos los productos</h1>

    <section class="grid grid-cols-1 gap-5 mt-4 md:grid-cols-3 lg:grid-cols-5">
        <x-products.product-card></x-products.product-card>
        <x-products.product-card></x-products.product-card>
        <x-products.product-card></x-products.product-card>
        <x-products.product-card></x-products.product-card>
        <x-products.product-card></x-products.product-card>
    </section>
</article>

@endsection
