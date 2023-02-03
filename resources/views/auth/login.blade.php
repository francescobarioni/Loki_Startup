<x-guest-layout>
    @section('title')
        - Login
    @endsection
    <style>
        div.min-h-screen{
            background-color: #212529;
        }
        div.w-full{
            background-color: #262d34;
        }
    </style>

    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" style="color: white" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus style="background-color: #2c2d32;color: white;" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" style="color: white" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" style="background-color: #2c2d32;color: white;" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" style="background-color: #2c2d32;"/>
                    <span class="ml-2 text-sm text-gray-600" style="color: white">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}" style="color: white">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="/register" style="color: white">
                Sign up here!
            </a>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
