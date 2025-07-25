<x-guest-layout>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <x-logo.logo class="mb-4"/>
        <x-card.auth>
            {{--            @session('status')--}}
            {{--            <div class="mb-4 font-medium text-sm text-success">--}}
            {{--                {{ $value }}--}}
            {{--            </div>--}}
            {{--            @endsession--}}
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <x-heading.headingauth>Complete registration</x-heading.headingauth>
                <form method="POST" action="{{ route('accept-invitation.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" id="invited_by" name="invited_by" value="{{ $invitation->invited_by }}">

                    <div>
                        <x-form.label for="username" value="{{ __('Username') }}"/>
                        <x-form.input id="username"
                                      name="username"
                                      type="text"
                                      class="block mt-1 w-full"
                                      :value="old('username')"
                                      placeholder="{{ __('username')}}"
                                      required
                                      autofocus
                                      autocomplete="username"/>
                        <x-form.error for="username"/>
                    </div>

                    <div>
                        <x-form.label for="name" value="{{ __('Full name') }}"/>
                        <x-form.input id="name"
                                      name="name"
                                      type="text"
                                      class="block mt-1 w-full"
                                      :value="old('name')"
                                      placeholder="{{ __('Full name')}}"
                                      required
                                      autocomplete="name"/>
                        <x-form.error for="name"/>
                    </div>

                    <div>
                        <x-form.label for="email" value="{{ __('Email') }}"/>
                        <x-form.input id="email"
                                      name="email"
                                      type="email"
                                      class="block mt-1 w-full"
                                      :value="old('email', $email)"
                                      placeholder="{{ __('Email')}}"
                                      required
                                      autocomplete="username"/>
                        <x-form.error for="email"/>
                    </div>

                    <div class="mt-4">
                        <x-form.label for="password" value="{{ __('Password') }}"/>
                        <x-form.input id="password"
                                      name="password"
                                      type="password"
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
                                      class="block mt-1 w-full"
                                      placeholder="{{ __('Confirm Password') }}"
                                      required
                                      autocomplete="new-password"/>
                        <x-form.error for="password_confirmation"/>
                    </div>


                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-form.checkbox name="terms" id="terms" required/>

                                    <div class="ms-2 text-primary-muted">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm font-medium text-primary-muted hover:text-secondary focus:outline-none focus:text-secondary">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm font-medium text-primary-muted hover:text-secondary focus:outline-none focus:text-secondary">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <div class="flex items-center justify-end gap-2 mt-4">
                        <x-link.default
                                href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </x-link.default>
                        <x-button.default type="submit">
                            {{ __('Register') }}
                        </x-button.default>
                    </div>
                </form>
            </div>
        </x-card.auth>
    </div>
</x-guest-layout>
