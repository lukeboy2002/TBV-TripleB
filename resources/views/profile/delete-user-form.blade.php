<x-action-section>
    <x-slot name="title">
        Verwijder account
    </x-slot>

    <x-slot name="description">
        Verwijder uw account definitief
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-primary-muted">
            Zodra uw account is verwijderd, worden alle bronnen en gegevens permanent verwijderd. Voordat u uw account
            verwijdert, downloadt u alle gegevens of informatie die u wilt behouden.
        </div>

        <div class="mt-5">
            <x-button.danger wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                Verwijder account
            </x-button.danger>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                Verwijder account
            </x-slot>

            <x-slot name="content">
                Weet u zeker dat u uw account wilt verwijderen? Zodra uw account is verwijderd, worden alle bronnen en
                gegevens permanent verwijderd. Voer uw wachtwoord in om te bevestigen dat u uw account definitief wilt
                verwijderen.

                <div class="mt-4" x-data="{}"
                     x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-form.input type="password" class="mt-1 block w-3/4"
                                  autocomplete="current-password"
                                  placeholder="Wachtwoord"
                                  x-ref="password"
                                  wire:model="password"
                                  wire:keydown.enter="deleteUser"/>

                    <x-input-error for="password" class="mt-2"/>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-button.secondary>

                <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
