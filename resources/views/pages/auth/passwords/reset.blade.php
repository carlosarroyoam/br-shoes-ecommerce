@extends('base.app')

@section('title', __('Reset Password'))

@section('content')
<article class="mx-auto md:w-6/12">
    <h1 class="text-2xl text-gray-900 uppercase">{{ __('Reset Password') }}</h1>
    <p class="text-base text-header-secondary">Inicia sesion y comienza a comprar tus zapatos favoritos...</p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <x-form-elements.text-field class="mt-4" name="email" type="email" autocomplete="email" autofocus required>
            <x-slot name="label">
                {{ __('E-Mail Address') }}
            </x-slot>
        </x-form-elements.text-field>

        <x-form-elements.text-field class="mt-2" name="password" type="password" autocomplete="new-password" required>
            <x-slot name="label">
                {{ __('Password') }}
            </x-slot>
        </x-form-elements.text-field>

        <x-form-elements.text-field class="mt-2" name="password_confirmation" type="password"
            autocomplete="new-password" required>
            <x-slot name="label">
                {{ __('Confirm Password') }}
            </x-slot>
        </x-form-elements.text-field>

        <x-form-elements.button class="mt-4" type="submit">
            <x-slot name="title">
                {{ __('Reset Password') }}
            </x-slot>
        </x-form-elements.button>
    </form>
</article>
@endsection
