<x-guest-layout title="Login">
    <div class="flex flex-col h-full">
        <div>
            <x-logo/>
        </div>
        <div class="h-full w-full flex flex-col items-center justify-center mx-auto">
            <div class="w-full max-w-md">
                <div>
                    <x-heading.main>{{ __{'Register'} }}</x-heading.main>
                </div>
                <div>
                    <x-card.default class="form">
                        <form method="POST" action="{{ route('register') }}" class="space-y-6">
                            @csrf
                            <div>
                                <x-form.label for="username" value="{{ __('Username') }}"/>
                                <x-form.input id="username" class="block mt-1 w-full" type="text" name="username"
                                              :value="old('username')"
                                              required autocomplete="username"/>
                                <x-form.error for="username"/>
                            </div>

                            <div>
                                <x-form.label for="name" value="{{ __('Full name') }}"/>
                                <x-form.input id="name" class="block mt-1 w-full" type="text" name="name"
                                              :value="old('name')"
                                              required autocomplete="name"/>
                                <x-form.error for="name"/>
                            </div>

                            <div>
                                <x-form.label for="email" value="{{ __('Email') }}"/>
                                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email"
                                              :value="old('email')"
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


                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div>
                                    <x-form.label for="terms">
                                        <div class="flex items-center">
                                            <x-form.checkbox name="terms" id="terms" required/>

                                            <div class="ms-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-primary hover:text-secondary focus:outline-none focus:text-secondary">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-primary hover:text-secondary focus:outline-none focus:text-secondary">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-form.label>
                                </div>
                            @endif


                            <x-button.default class="w-full">
                                {{ __('Register') }}
                            </x-button.default>

                            <div class="flex justify-end">
                                <x-link.default href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </x-link.default>
                            </div>
                        </form>
                    </x-card.default>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>