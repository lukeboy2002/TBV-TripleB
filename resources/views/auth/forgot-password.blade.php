<x-guest-layout title="Login">
    <div class="flex flex-col h-full">
        <div>
            <x-logo/>
        </div>
        <div class="h-full w-full flex flex-col items-center justify-center mx-auto">
            <div class="w-full max-w-md">
                <div>
                    <x-heading.main>{{ __('Forgot Password') }}</x-heading.main>
                </div>
                <div>
                    <x-card.default>
                        <div class="mb-4 text-sm text-primary">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>
                        @session('status')
                        <div class="my-2 font-medium text-sm text-success">
                            {{ $value }}
                        </div>
                        @endsession
                        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                            @csrf
                            <div>
                                <x-form.label for="email" value="{{ __('Email') }}"/>
                                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email"
                                              :value="old('email')"
                                              required autocomplete="email"/>
                                <x-form.error for="email"/>
                            </div>

                            <x-button.default class="w-full">
                                {{ __('Email Password Reset Link') }}
                            </x-button.default>
                        </form>
                    </x-card.default>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>