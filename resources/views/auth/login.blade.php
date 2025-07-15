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
                <x-heading.headingauth>Sign in to your account</x-heading.headingauth>
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <x-form.label for="username" value="{{ __('Username') }}"/>
                        <x-form.input id="username"
                                      name="username"
                                      type="text"
                                      class="block mt-1 w-full"
                                      :value="old('username')"
                                      icon="user"
                                      placeholder="{{ __('Username')}}"
                                      required
                                      autofocus
                                      autocomplete="username"/>
                        <x-form.error for="username"/>
                    </div>

                    <div class="mt-4">
                        <x-form.label for="password" value="{{ __('Password') }}"/>
                        <x-form.input id="password"
                                      name="password"
                                      type="password"
                                      class="block mt-1 w-full"
                                      icon="lock"
                                      placeholder="{{ __('Password') }}"
                                      required
                                      autocomplete="current-password"/>
                        <x-form.error for="password"/>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <x-form.checkbox id="remember"
                                                 name="remember"
                                />
                            </div>
                            <div class="ml-3 text-sm">
                                <x-form.label for="remember" value="{{ __('Remember me') }}"/>
                            </div>
                        </div>
                        @if (Route::has('password.request'))
                            <x-link.default href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </x-link.default>
                        @endif
                    </div>
                    <x-button.default type="submit" class="w-full">
                        <x-lucide-key-round class="w-4 h-4 mr-2"/>
                        {{ __('Sign in') }}
                    </x-button.default>

                    @if (Route::has('register'))
                        <div class="flex justify-end">
                            <p class="text-sm font-light text-primary-muted">
                                Don’t have an account yet?
                                <x-link.default href="{{ route('register') }}">
                                    {{ __('Sign up') }}
                                </x-link.default>
                            </p>
                        </div>
                    @endif
                </form>
            </div>
        </x-card.auth>
    </div>
</x-guest-layout>
