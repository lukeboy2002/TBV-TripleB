<div>
    <x-heading.sub>{{ __('Edit User') }}, {{ $user->username }}</x-heading.sub>
    <div class="flex flex-col gap-6">
        <x-card.default>
            <div class="flex flex-col gap-2 mb-4">
                <div class="text-primary text-xl">{{ ucfirst($user->username) }}</div>
                <div class="text-sm text-primary italic">{{ $user->name }}</div>
            </div>

            <x-heading.side>{{ __('Change Role') }}</x-heading.side>
            <form wire:submit.prevent="updateRole">
                <div class="max-w-sm">
                    <label class="block text-sm text-primary mb-1">Role</label>
                    <select wire:model="selectedRole"
                            class="w-full rounded-md border border-secondary/30 bg-background px-3 py-2 text-primary focus:outline-none focus:ring-2 focus:ring-secondary">
                        @foreach($availableRoles as $roleName)
                            <option value="{{ $roleName }}">{{ ucfirst($roleName) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end mt-4">
                    <x-button.default>{{ __('Save') }}</x-button.default>
                </div>
            </form>

            <x-heading.side>{{ __('Add or change additional permissions') }}</x-heading.side>
            <form wire:submit.prevent="updatePermissions">
                <div class="flex flex-wrap gap-4">
                    @foreach($allPermissions as $permission)
                        <label class="flex items-center text-primary space-x-2 p-2 border border-secondary/30 rounded-lg cursor-pointer hover:bg-background-hover hover:text-secondary hover:border-secondary">
                            <x-form.checkbox
                                    type="checkbox"
                                    wire:model="selectedPermissions"
                                    value="{{ $permission }}"
                            />
                            <span>{{ $permission }}</span>
                        </label>
                    @endforeach
                </div>
                <div class="flex justify-end">
                    <x-button.default>{{ __('Save') }}</x-button.default>
                </div>
            </form>
        </x-card.default>
    </div>
</div>
