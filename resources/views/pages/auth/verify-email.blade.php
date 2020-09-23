<x-app-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="mb-4 text-sm font-medium text-green-600">
        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
    </div>
    @endif

    <div class="flex items-center justify-between mt-4">
        <form method="POST" action="/email/verification-notification">
            @csrf

            <div class="flex flex-col mt-5">
                <x-forms.button type="submit">
                    <x-slot name="title">
                        {{ __('Resend Verification Email') }}
                    </x-slot>
                </x-forms.button>
            </div>
        </form>

        <form method="POST" action="/logout">
            @csrf

            <div class="flex flex-col mt-5">
                <x-forms.button type="submit">
                    <x-slot name="title">
                        {{ __('Logout') }}
                    </x-slot>
                </x-forms.button>
            </div>
        </form>
    </div>
</x-app-layout>
