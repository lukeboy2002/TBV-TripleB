<x-guest-layout title="2FA">
    <div class="flex flex-col h-full">
        <div>
            <x-logo/>
        </div>
        <div class="h-full w-full flex flex-col items-center justify-center mx-auto">
            <div class="w-full max-w-md">
                <div>
                    <x-heading.main>{{ __('Login') }}</x-heading.main>
                </div>
                <div>
                    <x-card.default>
                        <div x-data="{ recovery: false }">
                            <div class="mb-4 text-sm text-primary-muted" x-show="! recovery">
                                {{ __('Confirm access to your account by entering the authentication code you received with your authentication application.') }}
                            </div>

                            <div class="mb-4 text-sm text-primary-muted" x-cloak x-show="recovery">
                                {{ __('Confirm access to your account by entering one of your recovery codes.') }}
                            </div>

                            <x-validation-errors class="mb-4"/>

                            <form method="POST" action="{{ route('two-factor.login') }}">
                                @csrf

                                <div class="mt-4" x-show="! recovery">
                                    <x-form.label for="code" value="{{ __('Code') }}"/>
                                    <x-form.input id="code" class="block mt-1 w-full" type="text" inputmode="numeric"
                                                  name="code" autofocus
                                                  x-ref="code" autocomplete="one-time-code"/>
                                </div>

                                <div class="mt-4" x-cloak x-show="recovery">
                                    <x-form.label for="recovery_code" value="{{ __('Recovery code') }}"/>
                                    <x-form.input id="recovery_code" class="block mt-1 w-full" type="text"
                                                  name="recovery_code"
                                                  x-ref="recovery_code" autocomplete="one-time-code"/>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-button.secondary type="button"
                                                        x-show="! recovery"
                                                        x-on:click="
                                                            recovery = true;
                                                            $nextTick(() => { $refs.recovery_code.focus() })
                                                        ">
                                        {{ __('Use recovery code') }}
                                    </x-button.secondary>

                                    <x-button.secondary type="button"
                                                        x-cloak
                                                        x-show="recovery"
                                                        x-on:click="
                                                            recovery = false;
                                                            $nextTick(() => { $refs.code.focus() })
                                                        ">
                                        {{ __('Use authentication code') }}
                                    </x-button.secondary>


                                    <x-button.default class="ms-4">
                                        {{ __('Login') }}
                                    </x-button.default>
                                </div>
                            </form>
                        </div>
                    </x-card.default>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
