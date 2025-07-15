<x-guest-layout>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <x-logo.logo class="mb-4"/>
        <x-card.auth>
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <x-heading.headingauth>Forgot your password</x-heading.headingauth>
                <div class="mb-8 text-sm text-primary-muted">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf
                    <div>
                        <x-form.label for="email" value="{{ __('Email') }}"/>
                        <x-form.input id="email"
                                      name="email"
                                      type="email"
                                      class="block mt-1 w-full"
                                      icon="mail"
                                      :value="old('email')"
                                      placeholder="{{ __('Email')}}"
                                      required
                                      autocomplete="username"/>
                        <x-form.error for="email"/>
                        @session('status')
                        <x-form.success :message="session('status')"/>
                        @endsession
                    </div>


                    <div class="flex items-center justify-end gap-2 mt-4">
                        <x-button.default type="submit">
                            {{ __('Email Password Reset Link') }}
                        </x-button.default>
                    </div>
                </form>
            </div>
        </x-card.auth>
    </div>
</x-guest-layout>
