@extends('base.app')

@section('title',__('Reset Password'))

@section('content')
<article class="mx-auto md:w-6/12">
    <h1 class="text-2xl text-gray-900 uppercase">{{ __('Reset Password') }}</h1>
    <p class="text-base text-body-secondary">Inicia sesion y comienza a comprar tus zapatos favoritos...</p>

    @if (session('status'))
    <div class="" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <x-forms.text-field class="mt-4" name="email" type="email" autocomplete="email" autofocus required>
            <x-slot name="label">
                {{ __('E-Mail Address') }}
            </x-slot>
        </x-forms.text-field>

        <x-forms.button class="mt-4" type="submit">
            <x-slot name="title">
                {{ __('Send Password Reset Link') }}
            </x-slot>
        </x-forms.button>
    </form>
</article>
@endsection
