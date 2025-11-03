<x-guest-layout title="Login">
    <div class="flex flex-col h-full">
        <div>
            <x-logo/>
        </div>
        <div class="h-full w-full flex flex-col items-center justify-center mx-auto">
            <div class="w-full max-w-md px-3 lg:px-0">
                <div>
                    <x-heading.main>Login</x-heading.main>
                </div>
                <div>
                    <x-card.default class="form">
                        {{--                        TODO: LOGIN BANNNED USER NOT ALLOWED--}}
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            <div>
                                <x-form.label for="username" value="Gebruikersnaam"/>
                                <x-form.input id="username" class="block mt-1 w-full" type="text" name="username"
                                              icon="user"
                                              :value="old('username')"
                                              required autocomplete="username"/>
                                <x-form.error for="username"/>
                            </div>
                            <div>
                                <div class="flex justify-between items-center">
                                    <x-form.label for="password" value="Wachtwoord"/>
                                    <div class="flex items-center justify-end">
                                        @if (Route::has('password.request'))
                                            <x-link.default
                                                    href="{{ route('password.request') }}">
                                                Vergeten?
                                            </x-link.default>
                                        @endif
                                    </div>
                                </div>

                                <x-form.input id="password" class="block mt-1 w-full" type="password" name="password"
                                              icon="lock"
                                              required
                                              autocomplete="current-password"/>
                                <x-form.error for="password"/>
                            </div>
                            <div>
                                <x-form.label for="remember_me">
                                    <x-form.checkbox id="remember_me" name="remember"/>
                                    <span class="ms-2 text-sm text-primary-muted">Onthoud mij</span>
                                </x-form.label>
                            </div>

                            <x-button.default class="w-full">
                                {{ __('Log in') }}
                            </x-button.default>

                            @if (Route::has('register'))
                                <div class="flex justify-end">
                                    <p class="text-sm font-light text-primary-muted">
                                        Nog geen account?
                                        <x-link.default href="{{ route('register') }}">
                                            registreer
                                        </x-link.default>
                                    </p>
                                </div>
                            @endif
                        </form>
                    </x-card.default>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>