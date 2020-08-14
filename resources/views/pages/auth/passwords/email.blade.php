@extends('base.app')

@section('title',__('Reset Password'))

@section('content')
<div class="w-4/12 mx-auto">
    <h1 class="text-2xl text-gray-900 uppercase">{{ __('Reset Password') }}</h1>

    @if (session('status'))
    <div class="" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="">
            <label for="email" class="">{{ __('E-Mail Address') }}</label>

            <div class="">
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="">
            <div class="">
                <button type="submit" class="">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
