<div>
    <button wire:click="toggleModal" data-popover-target="tooltip-login"
            class="flex items-center justify-center text-primary gap-2">
        @if($showIcon)
            <x-lucide-key-round class="w-5 h-5"/>
            <div id="tooltip-login" role="tooltip"
                 class="absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
                Login
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        @endif
        @if($showLabel)
            <span class="text-primary underline text-xs hover:text-secondary focus:outline-none focus:text-secondary transition duration-150 ease-in-out">{{ __('Login') }}</span>
        @endif
    </button>

    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-background/75" aria-hidden="true"
                     wire:click="toggleModal"></div>

                <!-- Main modal -->
                <div class="flex justify-between items-center h-screen max-w-md mx-auto">
                    <div class="relative bg-background rounded-lg shadow-sm w-full">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-xl font-semibold text-secondary font-secondary">
                                Sign in to our platform
                            </h3>
                            <button type="button"
                                    class="end-2.5 text-primary hover:text-secondary text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="authentication-modal" wire:click="toggleModal">
                                <x-lucide-x class="h-5 w-5"/>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            @if($showingTwoFactorForm)
                                <div x-data="{ recovery: @entangle('recovery') }">
                                    <div class="mb-4 text-sm text-primary" x-show="! recovery">
                                        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                                    </div>

                                    <div class="mb-4 text-sm text-primary" x-cloak x-show="recovery">
                                        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                                    </div>

                                    <form wire:submit.prevent="verifyTwoFactorCode">
                                        <div class="mt-4" x-show="! recovery">
                                            <x-tbv-label class="text-left" for="code" value="{{ __('Code') }}" />
                                            <x-tbv-input id="code" 
                                                class="block mt-1 w-full" 
                                                type="text" 
                                                inputmode="numeric" 
                                                wire:model="code" 
                                                autofocus 
                                                autocomplete="one-time-code" />
                                            @error('code')
                                            <div class="mt-2">
                                                <p class="text-sm text-error flex gap-2 items-center">
                                                    <x-lucide-triangle-alert class="h-5 w-5 mr-2"/>
                                                    {{ $message }}
                                                </p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mt-4" x-cloak x-show="recovery">
                                            <x-tbv-label class="text-left" for="recovery_code" value="{{ __('Recovery Code') }}" />
                                            <x-tbv-input id="recovery_code" 
                                                class="block mt-1 w-full" 
                                                type="text" 
                                                wire:model="code" 
                                                autocomplete="one-time-code" />
                                            @error('code')
                                            <div class="mt-2">
                                                <p class="text-sm text-error flex gap-2 items-center">
                                                    <x-lucide-triangle-alert class="h-5 w-5 mr-2"/>
                                                    {{ $message }}
                                                </p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            <button type="button" 
                                                class="text-sm text-primary hover:text-secondary underline cursor-pointer"
                                                x-show="! recovery"
                                                x-on:click="$wire.toggleRecoveryMode()">
                                                {{ __('Use a recovery code') }}
                                            </button>

                                            <button type="button" 
                                                class="text-sm text-primary hover:text-secondary underline cursor-pointer"
                                                x-cloak
                                                x-show="recovery"
                                                x-on:click="$wire.toggleRecoveryMode()">
                                                {{ __('Use an authentication code') }}
                                            </button>

                                            <x-tbv-button class="ms-4" type="submit">
                                                {{ __('Log in') }}
                                            </x-tbv-button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <form wire:submit.prevent="login">
                                    <div>
                                        <x-tbv-label class="text-left" for="username" value="{{ __('Username') }}"/>
                                        <x-tbv-input id="username"
                                                    class="block mt-1 w-full"
                                                    type="text"
                                                    wire:model="username"
                                                    required
                                                    autocomplete="username"/>
                                        @error('login')
                                        <div class="mt-2">
                                            <p class="text-sm text-error flex gap-2 items-center">
                                                <x-lucide-triangle-alert class="h-5 w-5 mr-2"/>
                                                {{ $message }}
                                            </p>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <x-tbv-label class="text-left" for="password" value="{{ __('Password') }}"/>
                                        <x-tbv-input id="password"
                                                    class="block mt-1 w-full"
                                                    type="password"
                                                    wire:model="password"
                                                    required/>
                                    </div>

                                    <div class="block mt-4">
                                        <label for="remember_me" class="flex items-center">
                                            <x-checkbox id="remember_me"
                                                        wire:model="remember"
                                                        class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 rounded-sm focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/>
                                            <span class="ms-2 text-sm text-primary">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                            <x-tbv-link href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </x-tbv-link>
                                        @endif

                                        <x-tbv-button class="ms-4" type="submit">
                                            {{ __('Log in') }}
                                        </x-tbv-button>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
