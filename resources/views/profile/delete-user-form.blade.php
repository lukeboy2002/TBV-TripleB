<x-sections.action>
    <x-slot name="title">
        Delete Account
    </x-slot>

    <x-slot name="description">
        Permanently delete your account.
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-700 dark:text-white">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </div>

        <div class="mt-5">
            <x-buttons.danger class="px-3 py-2 text-xs font-medium" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                Delete Account
            </x-buttons.danger>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-modals.dialog wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                Delete Account
            </x-slot>

            <x-slot name="content">
                Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-forms.input type="password" class="mt-1 block w-3/4"
                                   autocomplete="current-password"
                                   placeholder="Password"
                                   x-ref="password"
                                   wire:model="password"
                                   wire:keydown.enter="deleteUser" />

                    <x-forms.input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-buttons.secondary class="px-3 py-2 text-xs font-medium" wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    Cancel
                </x-buttons.secondary>

                <x-buttons.danger class="px-3 py-2 text-xs font-medium" wire:click="deleteUser" wire:loading.attr="disabled">
                    Delete Account
                </x-buttons.danger>
            </x-slot>
        </x-modals.dialog>
    </x-slot>
</x-sections.action>
