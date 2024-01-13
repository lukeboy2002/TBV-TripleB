<x-guest-layout>
    <div class="bg-cover bg-center" style="background-image: url('{{asset('storage/backgrounds/register.jpg')}}')">
        <div class="flex justify-center items-center h-screen">
            <div class="bg-white/75 dark:bg-gray-800/75 mx-4 p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3">
                <h1 class="text-3xl font-bold mb-8 text-center text-orange-500">Register</h1>
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-forms.label for="username" value="Username" />
                        <x-forms.input type="text" name="username" id="username" :value="old('username')" required autofocus />
                        <x-forms.input-error for="username" class="mt-2" />
                    </div>
                    <div>
                        <x-forms.label for="email" value="Email" />
                        <x-forms.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                        <x-forms.input-error for="email" class="mt-2" />
                    </div>
                    <div>
                        <x-forms.label for="password" value="Password" />
                        <x-forms.input type="password" name="password" id="password" required autocomplete="current-password" />
                        <x-forms.input-error for="password" class="mt-2" />
                    </div>
                    <div>
                        <x-forms.label for="password_confirmation" value="Confirm Password" />
                        <x-forms.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-forms.input-error for="password_confirmation" class="mt-2" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div>
                            <x-forms.label for="terms">
                                <div class="flex items-center">
                                    <x-forms.checkbox name="terms" id="terms" required />
                                    <div class="ml-2">
                                        I agree to the
                                        <x-links.primary class="underline" href="{{ route('terms.show') }}">Terms of Service</x-links.primary>
                                        and
                                        <x-links.primary class="underline" href="{{ route('policy.show') }}">Privacy Policy</x-links.primary>
                                    </div>
                                </div>
                            </x-forms.label>
                        </div>
                    @endif
                    <div class="flex items-center justify-end">
                        <x-links.primary href="{{ route('login') }}">Already registered?</x-links.primary>
                    </div>
                    <x-buttons.primary class="px-5 py-2.5 text-sm font-medium w-full">Register</x-buttons.primary>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
