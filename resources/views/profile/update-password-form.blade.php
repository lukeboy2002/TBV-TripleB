<x-sections.form submit="updatePassword">
    <x-slot name="title">
        Update Password
    </x-slot>

    <x-slot name="description">
        Ensure your account is using a long, random password to stay secure.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-forms.label for="current_password" value="{{ __('Current Password') }}" />
            <x-forms.input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-forms.input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-forms.label for="password" value="{{ __('New Password') }}" />
            <x-forms.input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-forms.input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-forms.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-forms.input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-forms.input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3 flex items-center" on="saved">
            <x-icons name="check" class="mr-1"/>Saved.
        </x-action-message>

        <x-buttons.primary class="px-3 py-2 text-xs font-medium">Save</x-buttons.primary>
    </x-slot>
</x-sections.form>
