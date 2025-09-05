<x-action-section>
    <x-slot name="title">
        Two Factor Authentication
    </x-slot>

    <x-slot name="description">
        Voeg extra beveiliging toe aan uw account met behulp van tweefactorauthenticatie
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    <div class="text-edit flex gap-2 items-center">
                        <x-lucide-circle-check-big class="h-5 w-5"/>
                        Voltooi het inschakelen van tweefactorauthenticatie
                    </div>
                @else
                    <div class="text-success flex gap-2 items-center">
                        <x-lucide-circle-check class="h-5 w-5"/>
                        U heeft tweefactorauthenticatie ingeschakeld.
                    </div>
                @endif
            @else
                <div class="text-error flex gap-2 items-center">
                    <x-lucide-triangle-alert class="h-5 w-5"/>
                    U heeft tweefactorauthenticatie niet ingeschakeld
                </div>
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-primary-muted">
            <p>Wanneer tweefactorauthenticatie is ingeschakeld, wordt u tijdens de authenticatie om een veilig,
                willekeurig token gevraagd. U kunt dit token ophalen via bijvoorbeeld Google Authenticator-applicatie
                van uw telefoon
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-primary-muted">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            Om het inschakelen van tweefactorauthenticatie te voltooien, scant u de volgende QR-code
                            met bijvoorbeeld Google Authenticator-applicatie op uw telefoon of voert u de
                            installatiesleutel in en geeft u
                            degegenereerde OTP-code op.
                        @else
                            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4 p-2 inline-block bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-primary-muted">
                    <p class="font-semibold">
                        {{ __('Setup Key') }}: <span
                                class="text-secondary">{{ decrypt($this->user->two_factor_secret) }}</span>
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-form.label for="code" value="{{ __('Code') }}"/>

                        <x-form.input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric"
                                      autofocus autocomplete="one-time-code"
                                      wire:model="code"
                                      wire:keydown.enter="confirmTwoFactorAuthentication"/>

                        <x-input-error for="code" class="mt-2"/>
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-primary-muted">
                    <p class="font-semibold">
                        Bewaar deze herstelcodes op een veilige plek. Ze kunnen worden gebruikt om de toegang tot uw
                        account te herstellen als uw twee factor authenticatie apparaat verloren is gegaan
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-background-hover text-primary rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button.default type="button" wire:loading.attr="disabled">
                        Inschakelen
                    </x-button.default>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="me-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button.default type="button" class="me-3" wire:loading.attr="disabled">
                            Bevestig
                        </x-button.default>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-button.default class="me-3">
                            Herstel codes weergeven
                        </x-button.default>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-button.secondary wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-button.secondary>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled">
                            Uitschakelen
                        </x-danger-button>
                    </x-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-action-section>
