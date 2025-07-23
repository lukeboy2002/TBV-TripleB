<div>
    <x-heading.heading1>Edit {{ $user->username }}</x-heading.heading1>

    <x-heading.heading2>Change role</x-heading.heading2>
    <x-card.default>
        <form wire:submit="changeRole" class="mt-4">
            <div>
                <x-form.label for="selectedRole" value="Role"/>
                <x-form.select id="selectedRole"
                               wire:model="selectedRole"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </x-form.select>
                <x-form.error for="selectedRole" class="mt-2"/>
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <x-button.default type="submit" class="px-3 py-2 text-xs font-medium">Change Role</x-button.default>
            </div>
        </form>
    </x-card.default>

    <x-heading.heading2>Permissions</x-heading.heading2>
    <x-card.default>
        <div class="flex flex-wrap">
            @if ($user->permissions)
                @forelse($user->getAllPermissions() as $permission)
                    <div class="relative inline-flex mr-2 mb-2">
                        <div class="flex items-center text-primary text-sm bg-background border border-secondary/30 hover:bg-background-hover hover:border-secondary focus:outline-none focus:bg-background-hover focus:border-secondary rounded-md px-3 py-1">
                            <span>{{ $permission->name }}</span>
                            <button
                                    wire:click="revokePermission({{ $permission->id }})"
                                    class="ml-2 text-error"
                            >
                                <x-lucide-x class="w-3 h-3"/>

                            </button>
                        </div>
                    </div>
                @empty
                    <div class="flex justify-center items-center w-full">
                        <div class="flex flex-col justify-center items-center h-40 space-y-4">
                            <div class="text-secondary">
                                <x-lucide-circle-x class="h-8 w-8"/>
                            </div>
                            <p class="text-xl font-bold tracking-tight text-primary">No records
                                found</p>
                        </div>
                    </div>
                @endforelse
            @endif
        </div>

        <form wire:submit="givePermission" class="mt-4">
            <div>
                <x-form.label for="permission" value="Available Permissions"/>
                <div class="flex space-x-2">
                    <x-form.select id="permission"
                                   wire:model="selectedPermission"
                                   wire:change="$set('newPermission', '')"
                                   class="w-full"
                                   :disabled="$newPermission !== ''">
                        <option value="">Select an available permission</option>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                        @endforeach
                    </x-form.select>
                    <span class="text-primary-muted flex items-center">or</span>
                    <div class="w-full">
                        <x-form.input id="new_permission"
                                      wire:model="newPermission"
                                      wire:input="$set('selectedPermission', '')"
                                      type="text"
                                      class="w-full"
                                      placeholder="Enter new permission name"
                                      :disabled="$selectedPermission !== ''"
                        />
                    </div>
                </div>
                <x-form.error for="permission" class="mt-2"/>
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <x-button.default type="submit" class="px-3 py-2 text-xs font-medium">Assign</x-button.default>
            </div>
        </form>
    </x-card.default>
</div>