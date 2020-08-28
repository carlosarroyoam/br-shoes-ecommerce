@extends('base.app')

@section('title', __('Verify Your Email Address'))

@section('content')
<article class="mx-auto md:w-6/12">
    <h1 class="text-2xl text-gray-900 uppercase">{{ __('Verify Your Email Address') }}</h1>
    <p class="text-base text-header-secondary">Inicia sesion y comienza a comprar tus zapatos favoritos...</p>

    @if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <x-form-elements.button class="mt-4" type="submit">
            <x-slot name="title">
                {{ __('click here to request another') }}
            </x-slot>
        </x-form-elements.button>
    </form>
</article>
@endsection
