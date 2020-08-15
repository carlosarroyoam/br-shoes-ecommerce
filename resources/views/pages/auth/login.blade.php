@extends('layouts.main')

@section('title', __('Login'))

@section('main-content')
<div class="mx-auto md:w-6/12">
    <h1 class="text-2xl text-gray-900 uppercase">{{ __('Login') }}</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mt-4">
            <label for="email" class="text-sm text-gray-700 uppercase">{{ __('E-Mail Address') }}</label>

            <div class="flex flex-col">
                <input id="email"
                    class="px-3 py-2 bg-white border border-gray-500 rounded-md outline-none focus:shadow-outline focus:bg-blue-100"
                    type="email" class="@error('email') text-red-600 @enderror" name="email" value="{{ old('email') }}"
                    required autocomplete="email" autofocus>

                @error('email')
                <span class="mt-2 text-sm text-red-600 uppercase" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="mt-2">
            <label for="password" class="text-sm text-gray-700 uppercase">{{ __('Password') }}</label>

            <div class="flex flex-col">
                <input id="password" type="password"
                    class="outline-none focus:shadow-outline focus:bg-blue-100 px-3 py-2 bg-white border border-gray-500 rounded-md @error('password') text-red-600 @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                <span class="mt-2 text-sm text-red-600 uppercase" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="mt-3">
            <div class="">
                <div class="">
                    <input class="" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <div class="flex flex-col">
                <x-button type="submit">
                    <x-slot name="title">
                        {{ __('Login') }}
                    </x-slot>
                </x-button>

                @if (Route::has('password.request'))
                <a class="mt-4" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
