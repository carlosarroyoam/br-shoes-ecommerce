@extends('base.app')

@section('title', __('Confirm Password'))

@section('content')
<div class="mx-auto md:w-6/12">
    <h1 class="text-2xl text-gray-900 uppercase">{{ __('Confirm Password') }}</h1>

    <p>
        {{ __('Please confirm your password before continuing.') }}
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="">
            <label for="password" class="">{{ __('Password') }}</label>

            <div class="">
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password"
                    required autocomplete="current-password">

                @error('password')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="">
            <div class="">
                <button type="submit" class="">
                    {{ __('Confirm Password') }}
                </button>

                @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
