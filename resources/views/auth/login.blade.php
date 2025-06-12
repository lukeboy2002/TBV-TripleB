<x-app-layout title="Login">
    <x-tbv-heading_h3>Login</x-tbv-heading_h3>
    <div class="w-full md:flex md:justify-between bg-background border border-border rounded-lg shadow-sm">
        <div class="hidden md:block md:w-1/2 inset-0 overflow-hidden">
            <img class="h-full object-cover rounded-l-lg" src="{{asset('storage/assets/register.jpg')}}" alt="">
        </div>
        <form method="POST" action="{{ route('login') }}" class="w-full md:w-1/2 p-4">
            @csrf

            <div>
                <x-tbv-label for="username" value="{{ __('Username') }}"/>
                <x-tbv-input id="username" class="block mt-1 w-full" type="text" name="username"
                             :value="old('username')"
                             required autofocus autocomplete="username"/>
                <x-tbv-input-error for="username" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-tbv-label for="password" value="{{ __('Password') }}"/>
                <x-tbv-input id="password" class="block mt-1 w-full" type="password" name="password" required
                             autocomplete="current-password"/>
                <x-tbv-input-error for="password" class="mt-2"/>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-tbv-checkbox id="remember_me" name="remember"/>
                    <span class="ms-2 text-sm text-primary">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-2 mt-4">
                @if (Route::has('password.request'))
                    <x-tbv-link
                            href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </x-tbv-link>
                @endif

                <x-tbv-button>
                    {{ __('Log in') }}
                </x-tbv-button>
            </div>
        </form>
    </div>
</x-app-layout>