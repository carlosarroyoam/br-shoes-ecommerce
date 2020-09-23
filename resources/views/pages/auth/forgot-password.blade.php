<x-app-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    @if (session('status'))
    <div class="mb-4 text-sm font-medium text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="/forgot-password">
        @csrf

        <x-forms.text-field class="mt-5" name="email" type="email" placeholder="{{ __('input-placeholders.email') }}"
            autocomplete="email" autofocus required>
            <x-slot name="label">
                {{ __('E-Mail Address') }}
            </x-slot>
        </x-forms.text-field>

        <div class="flex flex-col mt-5">
            <x-forms.button type="submit">
                <x-slot name="title">
                    {{ __('Email Password Reset Link') }}
                </x-slot>
            </x-forms.button>
        </div>
    </form>
</x-app-layout>
