<x-app-layout>
    <article class="mx-auto md:w-6/12">
        <h1 class="text-2xl uppercase text-header">{{ __('Login') }}</h1>
        <p class="text-base text-body-secondary">Inicia sesion y comienza a comprar tus zapatos favoritos...</p>

        @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf


            <x-forms.text-field class="mt-5" name="email" type="email"
                placeholder="{{ __('input-placeholders.email') }}" autocomplete="email" autofocus required>
                <x-slot name="label">
                    {{ __('E-Mail Address') }}
                </x-slot>
            </x-forms.text-field>

            <x-forms.text-field class="mt-3" name="password" type="password"
                placeholder="{{ __('input-placeholders.current-password') }}" autocomplete="current-password" required>
                <x-slot name="label">
                    {{ __('Password') }}
                </x-slot>
            </x-forms.text-field>

            <x-forms.check-box class="mt-4" name="remember">
                <x-slot name="label">
                    {{ __('Remember Me') }}
                </x-slot>
            </x-forms.check-box>

            <x-forms.button class="mt-5" type="submit">
                <x-slot name="title">
                    {{ __('Login') }}
                </x-slot>
            </x-forms.button>

            @if (Route::has('password.request'))
            <div class="flex flex-col">
                <a class="mt-4 text-sm text-center text-body-secondary hover:text-body"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
            @endif
        </form>
    </article>
</x-app-layout>
