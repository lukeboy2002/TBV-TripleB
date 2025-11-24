<x-guest-layout title="Account banned">
    <div class="flex flex-col h-full">
        <div>
            <x-logo/>
        </div>
        <div class="h-full w-full flex flex-col items-center justify-center mx-auto">
            <div class="w-full max-w-md px-3 lg:px-0">
                <div>
                    <x-heading.main>{{ __('Access denied') }}</x-heading.main>
                </div>
                <div>
                    <x-card.default class="space-y-6">
                        <div class="space-y-4">
                            <p class="text-primary-muted">
                                {{ __('Your account has been banned by the administrator. You cannot log in at this time.') }}
                            </p>
                            <p class="text-primary-muted">
                                {{ __('If you believe this is a mistake, please contact support or the site administrator.') }}
                            </p>
                        </div>
                        <div class="flex justify-end">
                            <x-link.default href="{{ route('home') }}">{{ __('Return to home') }}</x-link.default>
                        </div>
                    </x-card.default>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>