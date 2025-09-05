<x-form-section submit="updatePassword">
    <x-slot name="title">
        Verander wachtwoord
    </x-slot>

    <x-slot name="description">
        Zorg ervoor dat uw account een lang, willekeurig wachtwoord gebruikt om veilig te blijven.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-form.label for="current_password" value="{{ __('Huidig wachtwoord') }}"/>
            <x-form.input id="current_password" type="password" class="mt-1 block w-full"
                          wire:model="state.current_password"
                          autocomplete="current-password"/>
            <x-form.error for="current_password" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-form.label for="password" value="{{ __('Nieuw wachtwoord') }}"/>
            <x-form.input id="password" type="password" class="mt-1 block w-full" wire:model="state.password"
                          autocomplete="new-password"/>
            <x-form.error for="password" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-form.label for="password_confirmation" value="{{ __('Bevestig wachtwoord') }}"/>
            <x-form.input id="password_confirmation" type="password" class="mt-1 block w-full"
                          wire:model="state.password_confirmation" autocomplete="new-password"/>
            <x-form.error for="password_confirmation" class="mt-2"/>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            Opgeslagen
        </x-action-message>

        <x-button.default>
            {{ __('Save') }}
        </x-button.default>
    </x-slot>
</x-form-section>
