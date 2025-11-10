<x-action-section>
    <x-slot name="title">
        {{ __('Delete account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Delete your account permanently') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-primary-muted">
            {{ __('Once your account is deleted, all resources and data will be permanently deleted. Before you open your account delete, download any data or information you want to keep.') }}
        </div>

        <div class="mt-5">
            <x-button.danger wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Delete account') }}
            </x-button.danger>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your account? Once your account is deleted, all resources and data permanently deleted. Enter your password to confirm that you want your account permanent to delete.') }}

                <div class="mt-4" x-data="{}"
                     x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-form.input type="password" class="mt-1 block w-3/4"
                                  autocomplete="current-password"
                                  placeholder="{{ __("Password") }}"
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
