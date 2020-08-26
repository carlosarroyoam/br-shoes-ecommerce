@extends('base.app')

@section('title', __('Confirm Password'))

@section('content')
<div class="mx-auto md:w-6/12">
    <h1 class="text-2xl text-gray-900 uppercase">{{ __('Confirm Password') }}</h1>
    <p class="text-base text-header-secondary">
        {{ __('Please confirm your password before continuing.') }}
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <x-form-elements.text-field class="mt-2" name="password" type="password" autocomplete="current-password"
            required>
            <x-slot name="label">
                {{ __('Password') }}
            </x-slot>
        </x-form-elements.text-field>

        <x-button class="mt-4" type="submit">
            <x-slot name="title">
                {{ __('Confirm Password') }}
            </x-slot>
        </x-button>

        @if (Route::has('password.request'))
        <div class="flex flex-col">
            <a class="mt-4 text-sm text-center text-body-secondary hover:text-body"
                href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </div>
        @endif

    </form>
</div>
@endsection
