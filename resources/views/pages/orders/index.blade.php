@extends('base.app')

@section('title', __('navigation.orders'))

@section('content')

<article>
    <h1 class="text-2xl uppercase text-header">
        {{ __('navigation.orders') }}
    </h1>

    <a href="{{ route('shipments.index') }}"
        class="w-full mt-4 text-sm font-medium rounded-sm focus:outline-none focus:shadow-outline focus:text-body hover:text-body">
        go to {{ __('navigation.shipments') }}
    </a>

</article>

@endsection
