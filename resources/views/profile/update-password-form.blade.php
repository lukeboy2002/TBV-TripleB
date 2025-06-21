<div>
    <x-tbv-heading_h5>Update Password</x-tbv-heading_h5>
    <x-tbv-form-section submit="updatePassword">
        <x-slot name="form">
            <div>
                <x-tbv-label for="current_password" value="{{ __('Current Password') }}"/>
                <x-tbv-input id="current_password" type="password" class="mt-1 block w-full"
                             wire:model="state.current_password"
                             autocomplete="current-password"/>
                <x-tbv-input-error for="current_password" class="mt-2"/>
            </div>

            <div>
                <x-tbv-label for="password" value="{{ __('New Password') }}"/>
                <x-tbv-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password"
                             autocomplete="new-password"/>
                <x-tbv-input-error for="password" class="mt-2"/>
            </div>

            <div>
                <x-tbv-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                <x-tbv-input id="password_confirmation" type="password" class="mt-1 block w-full"
                             wire:model="state.password_confirmation" autocomplete="new-password"/>
                <x-tbv-input-error for="password_confirmation" class="mt-2"/>
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3 text-success" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-tbv-button>
                {{ __('Save') }}
            </x-tbv-button>
        </x-slot>
    </x-tbv-form-section>
</div>