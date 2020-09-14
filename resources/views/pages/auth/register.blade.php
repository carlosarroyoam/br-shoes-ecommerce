@extends('base.app')

@section('title', __('Register'))

@section('content')
<article class="mx-auto md:w-6/12">
    <h1 class="text-2xl text-gray-900 uppercase">{{ __('Register') }}</h1>
    <p class="text-base text-body-secondary">Registrate y comienza a comprar tus zapatos favoritos...</p>

    <form method="POST" action="{{ route('admin.register') }}">
        @csrf

        <x-forms.fieldset class="mt-6">
            <x-slot name="legend">{{ __('Personal Information') }}</x-slot>

            <x-forms.text-field class="mt-4" name="first_name" placeholder="{{ __('input-placeholders.given-name') }}"
                autocomplete="given-name" autofocus required withRequiredIndicator>
                <x-slot name="label">
                    {{ __('First Name') }}
                </x-slot>
            </x-forms.text-field>

            <x-forms.text-field class="mt-3" name="last_name" placeholder="{{ __('input-placeholders.family-name') }}"
                autocomplete="family-name" required withRequiredIndicator>
                <x-slot name="label">
                    {{ __('Last Name') }}
                </x-slot>
            </x-forms.text-field>
        </x-forms.fieldset>


        <x-forms.fieldset class="mt-6">
            <x-slot name="legend">{{ __('Account Information') }}</x-slot>

            <x-forms.text-field class="mt-4" name="email" placeholder="{{ __('input-placeholders.email') }}"
                autocomplete="email" required withRequiredIndicator>
                <x-slot name="label">
                    {{ __('E-Mail Address') }}
                </x-slot>
            </x-forms.text-field>

            <x-forms.text-field class="mt-3" name="password" placeholder="{{ __('input-placeholders.new-password') }}"
                type="password" autocomplete="new-password" required withRequiredIndicator>
                <x-slot name="label">
                    {{ __('Password') }}
                </x-slot>
            </x-forms.text-field>

            <x-forms.text-field class="mt-3" name="password_confirmation"
                placeholder="{{ __('input-placeholders.confirm-password') }}" type="password"
                autocomplete="new-password" required withRequiredIndicator>
                <x-slot name="label">
                    {{ __('Confirm Password') }}
                </x-slot>
            </x-forms.text-field>
        </x-forms.fieldset>

        <x-forms.check-box class="mt-4" name="agree-terms">
            <x-slot name="label">
                {{ __('I agree to the terms and conditions') }}
            </x-slot>
        </x-forms.check-box>

        <x-forms.button class="mt-5" type="submit">
            <x-slot name="title">
                {{ __('Register') }}
            </x-slot>
        </x-forms.button>
    </form>
</article>
@endsection
