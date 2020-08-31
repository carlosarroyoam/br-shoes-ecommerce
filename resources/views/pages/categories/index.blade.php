@extends('base.app')

@section('title', __('navigation.categories'))

@section('content')
<article>
    <h1 class="text-2xl uppercase text-header">
        {{ __('navigation.categories') }}
    </h1>

    @foreach ($categories as $category)
    <p>{{ $category->name }}</p>
    <p>{{ $category->slug }}</p>
    @endforeach
</article>
@endsection
