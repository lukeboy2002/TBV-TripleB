<x-card.default>
    <div class="relative overflow-x-auto shadow-md rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-primary-muted border border-secondary/30">
            <thead class="text-xs text-primary bg-background-hover">
            <tr>
                @include('livewire.table.sortable-th',[
                    'name' => 'name',
                     'displayName' => 'Name'
                ])
                <th scope="col" class="px-6 py-3">
                    Permissions
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($this->permissions as $permission)
                <tr wire:key="{{$permission->id}}" class="bg-transparent border-b border-secondary/30 ">
                    <th scope="row"
                        class="px-6 py-4 font-medium whitespace-nowrap ">
                        {{ ucfirst($permission->name) }}
                    </th>
                    <td class="px-6 py-4">
                        @foreach ($permission->roles as $role)
                            {{ ucfirst($role->name) }}
                            @if (!$loop->last)
                                |
                            @endif
                        @endforeach
                    </td>
                    <td class="py-4 text-right">
                        <div class="flex space-x-2 mr-2">
                            @if(auth()->user()->can('update:permission'))
                                <x-button.icon wire:click="updatePermission({{ $permission->id }})"
                                               class="text-edit"
                                               icon="square-pen"/>
                            @endif
                            @if(auth()->user()->can('delete:permission'))
                                <x-button.icon wire:click="deletePermission({{ $permission->id }})"
                                               class="text-error"
                                               icon="trash"/>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="py-4 px-3">
        <x-items-per-page/>
    </div>
    <div class="px-4 py-4">
        {{ $this->permissions->links() }}
    </div>

    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
             role="dialog"
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-background/75" aria-hidden="true"
                     wire:click="toggleModal"></div>

                <!-- Main modal -->
                <div class="flex justify-between items-center h-screen max-w-md mx-auto">
                    <div class="bg-background border border-secondary/30 relative rounded-lg shadow-sm w-full">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-secondary/30">
                            <h3 class="text-xl font-semibold text-secondary font-secondary">
                                Delete Permission
                            </h3>
                            <x-button.icon type="button"
                                           class="text-secondary"
                                           icon="x"
                                           wire:click="toggleModal"
                                           data-modal-hide="authentication-modal"/>
                            <span class="sr-only">Close modal</span>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <div class="flex justify-center mb-4 text-error" aria-hidden="true">
                                <x-lucide-circle-alert class="h-12 w-12"/>
                            </div>
                            <h3 class="mb-5 text-lg font-normal text-primary-muted">Are you sure you
                                want to delete this Permission</h3>
                            <x-button.default wire:click.prevent="confirmDelete" type="button">
                                Yes, I'm sure
                            </x-button.default>
                            <x-button.secondary wire:click="toggleModal" type="button">
                                No, cancel
                            </x-button.secondary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showRoleModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
             role="dialog"
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-background/75" aria-hidden="true"
                     wire:click="toggleRoleModal"></div>

                <!-- Main modal -->
                <div class="flex justify-between items-center h-screen max-w-md mx-auto">
                    <div class="bg-background border border-secondary/30 relative rounded-lg shadow-sm w-full">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-secondary/30">
                            <h3 class="text-xl font-semibold text-secondary font-secondary">
                                Assign Roles to Permission
                            </h3>
                            <x-button.icon type="button"
                                           class="text-secondary"
                                           icon="x"
                                           wire:click="toggleRoleModal"
                                           data-modal-hide="authentication-modal"/>
                            <span class="sr-only">Close modal</span>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4">
                            <h3 class="mb-5 text-lg font-normal text-primary-muted">Select roles to assign to this
                                permission:</h3>

                            <div class="mb-5 max-h-60 overflow-y-auto px-2">
                                @foreach($availableRoles as $role)
                                    <div class="flex items-center mb-2">
                                        <x-form.checkbox
                                                id="role-{{ $role->id }}"
                                                wire:model="selectedRoles"
                                                value="{{ $role->id }}"
                                        />
                                        <div class="ml-3 text-sm">
                                            <label for="role-{{ $role->id }}"
                                                   class="ml-2 text-sm font-medium text-primary-muted">
                                                {{ ucfirst($role->name) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <x-button.default wire:click.prevent="assignRoles" type="button">
                                Save
                            </x-button.default>
                            <x-button.secondary wire:click="toggleRoleModal" type="button">
                                Cancel
                            </x-button.secondary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-card.default>
