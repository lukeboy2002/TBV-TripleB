<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Change Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Make sure your account uses a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-form.label for="current_password" value="{{ __('Current password') }}"/>
            <x-form.input id="current_password" type="password" class="mt-1 block w-full"
                          wire:model="state.current_password"
                          autocomplete="current-password"/>
            <x-form.error for="current_password" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-form.label for="password" value="{{ __('New password') }}"/>
            <x-form.input id="password" type="password" class="mt-1 block w-full" wire:model="state.password"
                          autocomplete="new-password"/>
            <x-form.error for="password" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-form.label for="password_confirmation" value="{{ __('Confirm password') }}"/>
            <x-form.input id="password_confirmation" type="password" class="mt-1 block w-full"
                          wire:model="state.password_confirmation" autocomplete="new-password"/>
            <x-form.error for="password_confirmation" class="mt-2"/>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __("Saved") }}
        </x-action-message>

        <x-button.default>
            {{ __('Save') }}
        </x-button.default>
    </x-slot>
</x-form-section>
