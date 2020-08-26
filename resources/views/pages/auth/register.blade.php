@extends('base.app')

@section('title', __('Register'))

@section('content')
<div class="mx-auto md:w-6/12">
    <h1 class="text-2xl text-gray-900 uppercase">{{ __('Register') }}</h1>
    <p class="text-base text-header-secondary">Registrate y comienza a comprar tus zapatos favoritos...</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <x-form-elements.text-field class="mt-4" name="first_name" autocomplete="first_name" autofocus required>
            <x-slot name="label">
                {{ __('First Name') }}
            </x-slot>
        </x-form-elements.text-field>

        <x-form-elements.text-field class="mt-2" name="last_name" autocomplete="last_name" required>
            <x-slot name="label">
                {{ __('Last Name') }}
            </x-slot>
        </x-form-elements.text-field>

        <x-form-elements.text-field class="mt-2" name="email" autocomplete="email" required>
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

        <x-button class="mt-4" type="submit">
            <x-slot name="title">
                {{ __('Register') }}
            </x-slot>
        </x-button>
</div>
</form>
</div>
@endsection
