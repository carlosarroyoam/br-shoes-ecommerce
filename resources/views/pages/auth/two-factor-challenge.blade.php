<x-app-layout>
    <div x-data="{ recovery: false }">
        <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
        </div>

        <div class="mb-4 text-sm text-gray-600" x-show="recovery">
            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
        </div>


        <form method="POST" action="/two-factor-challenge">
            @csrf

            <x-forms.text-field class="mt-3" name="code" type="text" placeholder="{{ __('input-placeholders.Code') }}"
                x-show="! recovery" x-ref="code" autocomplete="one-time-code" required>
                <x-slot name="label">
                    {{ __('Password') }}
                </x-slot>
            </x-forms.text-field>

            <x-forms.text-field class="mt-3" name="recovery_code" type="text"
                placeholder="{{ __('input-placeholders.Recovery Code') }}" x-show="recovery" x-ref="recovery_code"
                autocomplete="one-time-code" required>
                <x-slot name="label">
                    {{ __('Password') }}
                </x-slot>
            </x-forms.text-field>

            <div class="flex items-center justify-end mt-4">
                <button type="button" class="text-sm text-gray-600 underline cursor-pointer hover:text-gray-900"
                    x-show="! recovery" x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                    {{ __('Use a recovery code') }}
                </button>

                <button type="button" class="text-sm text-gray-600 underline cursor-pointer hover:text-gray-900"
                    x-show="recovery" x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                    {{ __('Use an authentication code') }}
                </button>

                <div class="flex flex-col mt-5">
                    <x-forms.button type="submit">
                        <x-slot name="title">
                            {{ __('Login') }}
                        </x-slot>
                    </x-forms.button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
