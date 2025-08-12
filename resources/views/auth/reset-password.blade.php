<x-guest-layout title="Login">
    <div class="flex flex-col h-full">
        <div>
            <x-logo/>
        </div>
        <div class="h-full w-full flex flex-col items-center justify-center mx-auto">
            <div class="w-full max-w-md">
                <div>
                    <x-heading.main>Reset Password</x-heading.main>
                </div>
                <div>
                    <x-card.default class="form">
                        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div>
                                <x-form.label for="email" value="{{ __('Email') }}"/>
                                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email"
                                              :value="old('email', $request->email)"
                                              required autocomplete="email"/>
                                <x-form.error for="email"/>
                            </div>

                            <div>
                                <x-form.label for="password" value="{{ __('Password') }}"/>
                                <x-form.input id="password" class="block mt-1 w-full" type="password" name="password"
                                              required
                                              autocomplete="new-password"/>
                                <x-form.error for="password"/>
                            </div>

                            <div>
                                <x-form.label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                                <x-form.input id="password_confirmation" class="block mt-1 w-full" type="password"
                                              name="password_confirmation" required autocomplete="new-password"/>
                                <x-form.error for="password_confirmation"/>
                            </div>

                            <x-button.default class="w-full">
                                {{ __('Reset Password') }}
                            </x-button.default>
                        </form>
                    </x-card.default>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>