@extends('base.app')

@section('title', __('Login'))

@section('content')
<div class="mx-auto md:w-6/12">
    <h1 class="text-2xl uppercase text-header">{{ __('Login') }}</h1>
    <p class="text-base text-header-secondary">Inicia sesion y comienza a comprar tus zapatos favoritos...</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-form-elements.text-field class="mt-4" name="email" type="email" autocomplete="email" autofocus required>
            <x-slot name="label">
                {{ __('E-Mail Address') }}
            </x-slot>
        </x-form-elements.text-field>

        <x-form-elements.text-field class="mt-2" name="password" type="password" autocomplete="current-password"
            required>
            <x-slot name="label">
                {{ __('Password') }}
            </x-slot>
        </x-form-elements.text-field>

        <div class="mt-3">
            <div class="flex items-center">
                <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="ml-2 text-sm uppercase text-body-secondary" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>

        <x-button class="mt-4" type="submit">
            <x-slot name="title">
                {{ __('Login') }}
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
