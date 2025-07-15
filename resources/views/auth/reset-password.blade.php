<x-guest-layout>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <x-logo.logo class="mb-4"/>
        <x-card.auth>
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <x-heading.headingauth>Reset your Password</x-heading.headingauth>
                <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div>
                        <x-form.label for="email" value="{{ __('Email') }}"/>
                        <x-form.input id="email"
                                      name="email"
                                      type="email"
                                      class="block mt-1 w-full"
                                      icon="mail"
                                      :value="old('email', $request->email)"
                                      placeholder="{{ __('Email')}}"
                                      autofocus
                                      required
                                      autocomplete="username"/>
                        <x-form.error for="email"/>
                    </div>

                    <div class="mt-4">
                        <x-form.label for="password" value="{{ __('Password') }}"/>
                        <x-form.input id="password"
                                      name="password"
                                      type="password"
                                      icon="lock"
                                      class="block mt-1 w-full"
                                      placeholder="{{ __('Password') }}"
                                      required
                                      autocomplete="new-password"/>
                        <x-form.error for="password"/>
                    </div>

                    <div>
                        <x-form.label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                        <x-form.input id="password_confirmation"
                                      name="password_confirmation"
                                      type="password"
                                      icon="lock"
                                      class="block mt-1 w-full"
                                      placeholder="{{ __('Confirm Password') }}"
                                      required
                                      autocomplete="new-password"/>
                        <x-form.error for="password_confirmation"/>
                    </div>


                    <div class="flex items-center justify-end gap-2 mt-4">
                        <x-button.default type="submit">
                            {{ __('Reset Password') }}
                        </x-button.default>
                    </div>
                </form>
            </div>
        </x-card.auth>
    </div>
</x-guest-layout>

