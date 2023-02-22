<x-app-layout>
    <div class="flex min-h-full pt-4 sm:pt-0 mb-20">
        <div class="relative hidden w-0 flex-1 sm:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{asset('storage/backgrounds/login.jpeg')}}" alt="Background Inlog">
        </div>

        <div class="flex flex-1 flex-col justify-center px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 lg:my-14">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <x-main.application-logo />
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-orange-500">Register your account</h2>
                </div>
                <div class="my-8">

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf
                        <div>
                            <x-form.label for="username" value="Username" />
                            <x-form.input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                            <x-form.input-error for="username" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-form.label for="email" value="{{ __('Email') }}" />
                            <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                            <x-form.input-error for="email" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-form.label for="password" value="{{ __('Password') }}" />
                            <x-form.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            <x-form.input-error for="password" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-form.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-form.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-form.input-error for="password_confirmation" class="mt-2" />
                        </div>
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-form.label for="terms">
                                    <div class="flex items-center">
                                        <x-form.checkbox name="terms" id="terms" required />
                                        <div class="ml-2">
                                            I agree to the
                                            <x-links.primair class="underline" href="{{ route('terms.show') }}">Terms of Service</x-links.primair>
                                            and
                                            <x-links.primair class="underline" href="{{ route('policy.show') }}">Privacy Policy</x-links.primair>
                                        </div>
                                    </div>
                                </x-form.label>
                            </div>
                        @endif
                        <div class="flex items-center justify-end">
                            <x-links.primair href="{{ route('login') }}">Already registered?</x-links.primair>
                        </div>
                        <x-buttons.primair class="px-5 py-2.5 text-sm font-medium w-full">Register</x-buttons.primair>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
