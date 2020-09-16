<x-app-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="/reset-password">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label value="Email" />
                <x-jet-input class="block w-full mt-1" type="email" name="email" :value="old('email', $request->email)"
                    required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="Password" />
                <x-jet-input class="block w-full mt-1" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="Confirm Password" />
                <x-jet-input class="block w-full mt-1" type="password" name="password_confirmation" required
                    autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>