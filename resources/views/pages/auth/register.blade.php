@extends('base.app')

@section('title', __('Register'))

@section('content')
<div class="mx-auto md:w-6/12">
    <h1 class="text-2xl text-gray-900 uppercase">{{ __('Register') }}</h1>
    <p class="text-base text-header-secondary">Registrate y comienza a comprar tus zapatos favoritos...</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mt-4">
            <label for="first_name" class="text-sm uppercase text-body-secondary">{{ __('First Name') }}</label>

            <div class="flex flex-col">
                <input id="first_name" type="text"
                    class="@epx-3 py-2 border border-gray-400 rounded-md outline-none focus:shadow-outline @error('first_name') is-invalid @enderror"
                    name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                @error('first_name')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="mt-2">
            <label for="last_name" class="text-sm uppercase text-body-secondary">{{ __('Last Name') }}</label>

            <div class="flex flex-col">
                <input id="last_name" type="text"
                    class="@erpx-3 py-2 border border-gray-400 rounded-md outline-none focus:shadow-outline @error('last_name') is-invalid @enderror"
                    name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                @error('last_name')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="mt-2">
            <label for="email" class="text-sm uppercase text-body-secondary">{{ __('E-Mail Address') }}</label>

            <div class="flex flex-col">
                <input id="email" type="email"
                    class="@errorpx-3 py-2 border border-gray-400 rounded-md outline-none focus:shadow-outline @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="mt-2">
            <label for="password" class="text-sm uppercase text-body-secondary">{{ __('Password') }}</label>

            <div class="flex flex-col">
                <input id="password" type="password"
                    class="px-3 py-2 border border-gray-400 rounded-md outline-none focus:shadow-outline @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="mt-2">
            <label for="password-confirm"
                class="text-sm uppercase text-body-secondary">{{ __('Confirm Password') }}</label>

            <div class="flex flex-col">
                <input id="password-confirm" type="password"
                    class="px-3 py-2 border border-gray-400 rounded-md outline-none focus:shadow-outline @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="mt-4">
            <div class="flex flex-col">
                <x-button type="submit">
                    <x-slot name="title">
                        {{ __('Register') }}
                    </x-slot>
                </x-button>
            </div>
        </div>
    </form>
</div>
@endsection
