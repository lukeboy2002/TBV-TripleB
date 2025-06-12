<x-app-layout title="Accept Invitation">
    <x-tbv-heading_h3>Complete registration</x-tbv-heading_h3>
    <div class="w-full md:flex md:justify-between bg-background border border-border rounded-lg shadow-sm">
        <div class="hidden md:block md:w-1/2 inset-0 overflow-hidden">
            <img class="h-full object-cover rounded-l-lg" src="{{asset('storage/assets/register.jpg')}}" alt="">
        </div>
        <form method="POST" action="{{ route('accept-invitation.store') }}" class="w-full md:w-1/2 p-4">
            @csrf
            <div>
                <x-tbv-label for="username" value="{{ __('Username') }}"/>
                <x-tbv-input id="username" class="block mt-1 w-full" type="text" name="username"
                             :value="old('username')"
                             required autofocus autocomplete="username"/>
                <x-tbv-input-error for="username" class="mt-2"/>
            </div>
            <div class="mt-4">
                <x-tbv-label for="name" value="{{ __('Full name') }}"/>
                <x-tbv-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                             autofocus autocomplete="name"/>
                <x-tbv-input-error for="name" class="mt-2"/>
            </div>
            <div class="mt-4">
                <x-tbv-label for="email" value="{{ __('Email') }}"/>
                <x-tbv-input id="email" class="block mt-1 w-full" type="email" name="email"
                             :value="old('email', $email)" required autocomplete="email"/>
                <x-tbv-input-error for="email" class="mt-2"/>
            </div>
            <div class="mt-4">
                <x-tbv-label for="password" value="{{ __('Password') }}"/>
                <x-tbv-input id="password" class="block mt-1 w-full" type="password" name="password" required
                             autocomplete="new-password"/>
                <x-tbv-input-error for="password" class="mt-2"/>
            </div>
            <div class="mt-4">
                <x-tbv-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                <x-tbv-input id="password_confirmation" class="block mt-1 w-full" type="password"
                             name="password_confirmation" required autocomplete="new-password"/>
                <x-tbv-input-error for="password_confirmation" class="mt-2"/>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-tbv-label for="terms">
                        <div class="flex items-center">
                            <x-tbv-checkbox name="terms" id="terms" required/>

                            <div class="ms-2">
                                {!! __('I agree to the') !!}
                                <x-tbv-link href="{{ route('terms.show') }}">
                                    {{ __('terms of service') }}
                                </x-tbv-link>
                                and
                                <x-tbv-link class="text-sm" href="{{ route('policy.show') }}">
                                    {{ __('privacy policy') }}
                                </x-tbv-link>
                            </div>
                        </div>
                    </x-tbv-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <x-tbv-link href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </x-tbv-link>

                <x-tbv-button class="ms-4">
                    {{ __('Register') }}
                </x-tbv-button>
            </div>
        </form>
    </div>
</x-app-layout>
