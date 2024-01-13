<x-guest-layout>
    <div class="bg-cover bg-center" style="background-image: url('{{asset('storage/backgrounds/login.jpg')}}')">
        <div class="flex justify-center items-center h-screen">
            <div class="bg-white/75 dark:bg-gray-800/75 mx-4 p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3">
                <div x-data="{ recovery: false }">
                    <div class="mb-4 text-sm text-gray-700 dark:text-white" x-show="! recovery">
                        Please confirm access to your account by entering the authentication code provided by your authenticator application.
                    </div>

                    <div class="mb-4 text-sm text-gray-700 dark:text-white" x-cloak x-show="recovery">
                        Please confirm access to your account by entering one of your emergency recovery codes.
                    </div>

                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf

                        <div class="mt-4" x-show="! recovery">
                            <x-forms.label for="code" value="Code" />
                            <x-forms.input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                            <x-forms.input-error for="code" class="mt-2" />
                        </div>

                        <div class="mt-4" x-cloak x-show="recovery">
                            <x-forms.label for="recovery_code" value="Recovery Code" />
                            <x-forms.input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                            <x-forms.input-error for="recovery_code" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-buttons.secondary type="button" class="px-3 py-2 text-xs font-medium"
                                                 x-show="! recovery"
                                                 x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                                Use a recovery code
                            </x-buttons.secondary>

                            <x-buttons.secondary type="button" class="px-3 py-2 text-xs font-medium"
                                                 x-show="recovery"
                                                 x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                                Use an authentication code
                            </x-buttons.secondary>

                            <x-buttons.primary class="ml-4 px-3 py-2 text-xs font-medium">
                                Log in
                            </x-buttons.primary>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
