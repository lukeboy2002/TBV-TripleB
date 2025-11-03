<div>
    <div class="flex justify-between gap-4 mb-2">
        <div class="w-full">
            <x-heading.sub>All Roles</x-heading.sub>
        </div>
        <x-link.button href="{{ route('roles.create') }}">{{ __('New Role') }}</x-link.button>
    </div>
    <x-card.default>
        <div class="relative overflow-x-auto shadow-md rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-primary-muted border border-secondary/30">
                <thead class="text-xs text-primary bg-background-hover">
                <tr>
                    <th scope="col" class="px-6 py-3">{{ __('name') }}</th>
                    <th scope="col" class="px-6 py-3">{{ __('Permissions') }}</th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{{ __('Actions') }}</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr wire:key="{{$role->id}}" class="bg-transparent border-b border-secondary/30 ">
                        <td class="px-6 py-4 font-medium whitespace-nowrap ">
                            {{ $role->name }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($role->permissions as $permission)
                                    <x-badge.default>{{ $permission->name }}</x-badge.default>
                                @endforeach
                            </div>
                        </td>
                        <td class="py-4 pr-4 text-right flex item-center justify-end gap-2">
                            <x-link.icon :href="route('roles.edit', $role->id)"
                                         class="text-edit"
                                         icon="edit"/>
                            <x-button.icon wire:click="deleteRole({{ $role->id }})"
                                           class="text-error"
                                           icon="trash"/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-4">
            {{ $roles->links() }}
        </div>
    </x-card.default>
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
                                {{ __('Delete Role') }}
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
                            <h3 class="mb-5 text-lg font-normal text-primary-muted">{{ __('Are you sure you want to delete this role?') }}</h3>
                            <x-button.default wire:click.prevent="confirmDelete" type="button">
                                {{ __('Yes') }}
                            </x-button.default>
                            <x-button.secondary wire:click="toggleModal" type="button">
                                {{ __('No') }}
                            </x-button.secondary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
