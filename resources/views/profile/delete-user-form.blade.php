<div>
    <x-tbv-heading_h5>Delete Account</x-tbv-heading_h5>
    <x-tbv-action-section>


        <x-slot name="content">
            <div class="max-w-xl text-sm text-primary-muted">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </div>

            <div class="mt-5">
                <x-tbv-button-danger wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-tbv-button-danger>
            </div>

            <!-- Delete User Confirmation Modal -->
            <x-dialog-modal wire:model.live="confirmingUserDeletion">
                <x-slot name="title">
                    {{ __('Delete Account') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                    <div class="mt-4" x-data="{}"
                         x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                        <x-tbv-input type="password" class="mt-1 block w-3/4"
                                     autocomplete="current-password"
                                     placeholder="{{ __('Password') }}"
                                     x-ref="password"
                                     wire:model="password"
                                     wire:keydown.enter="deleteUser"/>

                        <x-tbv-input-error for="password" class="mt-2"/>
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <x-tbv-button_secondary wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-tbv-button_secondary>

                    <x-tbv-button-danger class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                        {{ __('Delete Account') }}
                    </x-tbv-button-danger>
                </x-slot>
            </x-dialog-modal>
        </x-slot>
    </x-tbv-action-section>
</div>