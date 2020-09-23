<x-app-layout>
    <form method="POST" action="/reset-password">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-forms.text-field class="mt-4" name="email" placeholder="{{ __('input-placeholders.email') }}"
            autocomplete="email">
            <x-slot name="label">
                {{ __('E-Mail Address') }}
            </x-slot>
        </x-forms.text-field>

        <x-forms.text-field class="mt-3" name="password" placeholder="{{ __('input-placeholders.new-password') }}"
            type="password" autocomplete="new-password">
            <x-slot name="label">
                {{ __('Password') }}
            </x-slot>
        </x-forms.text-field>

        <x-forms.text-field class="mt-3" name="password_confirmation"
            placeholder="{{ __('input-placeholders.confirm-password') }}" type="password" autocomplete="new-password">
            <x-slot name="label">
                {{ __('Confirm Password') }}
            </x-slot>
        </x-forms.text-field>

        <div class="flex flex-col mt-5">
            <x-forms.button type="submit">
                <x-slot name="title">
                    {{ __('Reset Password') }}
                </x-slot>
            </x-forms.button>
        </div>
    </form>
</x-app-layout>
