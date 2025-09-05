<x-guest-layout title="2FA">
    <div class="flex flex-col h-full">
        <div>
            <x-logo/>
        </div>
        <div class="h-full w-full flex flex-col items-center justify-center mx-auto">
            <div class="w-full max-w-md">
                <div>
                    <x-heading.main>Login</x-heading.main>
                </div>
                <div>
                    <x-card.default>
                        <div x-data="{ recovery: false }">
                            <div class="mb-4 text-sm text-primary-muted" x-show="! recovery">
                                Bevestig de toegang tot uw account door de authenticatie code in te voeren die u bij uw
                                authenticatie toepassing hebt ontvangen.
                            </div>

                            <div class="mb-4 text-sm text-primary-muted" x-cloak x-show="recovery">
                                Bevestig de toegang tot uw account door een van uw noodherstelcodes in te voeren.
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
                                    <x-form.label for="recovery_code" value="{{ __('Herstel Code') }}"/>
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
                                        Gebruik herstelcode
                                    </x-button.secondary>

                                    <x-button.secondary type="button"
                                                        x-cloak
                                                        x-show="recovery"
                                                        x-on:click="
                                                            recovery = false;
                                                            $nextTick(() => { $refs.code.focus() })
                                                        ">
                                        Gebruik authentication code
                                    </x-button.secondary>


                                    <x-button.default class="ms-4">
                                        {{ __('Log in') }}
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
