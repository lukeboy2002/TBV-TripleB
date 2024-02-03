<div>
    <x-slot name="header">
        All Members
    </x-slot>

    <div class="flex justify-between items-center space-x-4 pb-4 pt-2">
        <div class="flex items-center">
            <x-search/>
        </div>
        <div class="flex items-center">
            <x-links.btn-primary href="{{ route('admin.invitations.create') }}" class="px-3 py-2 text-xs font-medium">Invite User</x-links.btn-primary>

            @can('create:role')
                <x-links.btn-primary href="{{ route('admin.users.create') }}" class="px-3 py-2 text-xs font-medium">Create Member</x-links.btn-primary>
            @endcan
        </div>
    </div>
    @if (!$users->isEmpty())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @include('livewire.table.sortable-th',[
                        'name' => 'username',
                         'displayName' => 'Username'
                    ])
                    @include('livewire.table.sortable-th',[
                         'name' => 'email',
                          'displayName' => 'Email'
                     ])
                    @include('livewire.table.sortable-th',[
                        'name' => 'invited_by',
                         'displayName' => 'Invited'
                    ])
                    @include('livewire.table.sortable-th',[
                        'name' => 'model_id',
                         'displayName' => 'Role'
                    ])
                    <th scope="col" class="px-6 py-3">
                        Logged in
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last login time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr wire:key="{{$user->id}}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ucfirst($user->username) }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->invited_by }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->role_name }}
                        </td>
                        <td class="px-6 py-4">
                            @if( $user->logged_in =='1' )
                                <i class="fa-regular fa-circle-check text-green-600 fa-xl"></i>
                            @else
                                <i class="fa-regular fa-circle-xmark text-red-700 fa-xl"></i>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($user->last_login_time)
                                {{ $user->getLastLoginTime() }}
                            @else
                                <p>not available</p>
                            @endif
                        </td>
                        <td class="py-4 text-right">
                            @if ($user->trashed())
                                <div class="flex space-x-2">
                                @can('force-delete:user')
                                    <x-links.btn-primary href="{{ route('admin.users.trashed.restore' , $user->id) }}" class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-trash-arrow-up"></i></x-links.btn-primary>
                                    <x-buttons.danger class="px-2.5 py-2.5 text-xs font-medium" wire:click="forceDelete( {{ $user->id }})" wire:loading.attr="disabled">
                                        <i class="fa-solid fa-user-slash"></i>
                                    </x-buttons.danger>
                                @endcan
                                @hasrole('member')
                                <span class="px-2.5 py-2.5 text-xs font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">Deleted</span>
                                @endhasrole
                                </div>
                            @else
                                <div class="flex space-x-2">
                                @if($user->role_name === 'user')
                                    @can('update:user')
                                        @if( ($user->invited_by) == current_user()->username || current_user()->hasRole('admin') )
                                        <x-links.btn-primary
                                            href="{{ route('admin.users.edit' , $user) }}"
                                            class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-pen-to-square"></i>
                                        </x-links.btn-primary>
                                        @endif
                                    @endcan
                                    @can('delete:user')
                                        @if( ($user->invited_by) == current_user()->username || current_user()->hasRole('admin') )
                                        <x-buttons.danger class="px-3 py-2.5 text-xs font-medium" wire:click="delete( {{ $user->id }})" wire:loading.attr="disabled">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </x-buttons.danger>
                                        @endif
                                    @endcan
                                @endif
                                @if($user->role_name === 'member')
                                    @can('update:member')
                                        <x-links.btn-primary
                                            href="{{ route('admin.users.edit' , $user) }}"
                                            class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-pen-to-square"></i>
                                        </x-links.btn-primary>
                                    @endcan
                                    @can('delete:member')
                                        <x-buttons.danger class="px-3 py-2.5 text-xs font-medium" wire:click="delete( {{ $user->id }})" wire:loading.attr="disabled">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </x-buttons.danger>
                                    @endcan
                                @endif
                                </div>
                            @endif
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
            {{ $users->links() }}
        </div>
    @else
        <div class="flex flex-col justify-center items-center h-40 space-y-4">
            <div class="text-orange-500"><i class="fa-regular fa-circle-xmark fa-2xl"></i></div>
            <p class="text-xl font-bold tracking-tight text-gray-700 dark:text-white">No records found</p>
        </div>
    @endif

    <!-- Delete User Confirmation Modal -->
    <x-modals.dialog wire:model.live="confirmingDeletion">
        <x-slot name="title">
            Delete Account
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this account?
        </x-slot>

        <x-slot name="footer">
            <x-buttons.secondary class="px-3 py-2 text-xs font-medium" wire:click="$set('confirmingDeletion', false)" wire:loading.attr="disabled">
                Cancel
            </x-buttons.secondary>

            <x-buttons.danger class="px-3 py-2 text-xs font-medium" wire:click="deleteUser( {{ $confirmingDeletion }} )" wire:loading.attr="disabled">
                Delete Account
            </x-buttons.danger>
        </x-slot>
    </x-modals.dialog>

    <x-modals.dialog wire:model.live="confirmingForceDeletion">
        <x-slot name="title">
            Delete Account
        </x-slot>

        <x-slot name="content">

            <div class="flex space-x-3 items-center pb-4 text-md ">
                <x-icons name="error" class="text-sm text-red-700" />
                <p>All information of this User will be deleted</p>
            </div>
            Are you sure you want to delete this account?
        </x-slot>

        <x-slot name="footer">
            <x-buttons.secondary class="px-3 py-2 text-xs font-medium" wire:click="$set('confirmingForceDeletion', false)" wire:loading.attr="disabled">
                Cancel
            </x-buttons.secondary>

            <x-buttons.danger class="px-3 py-2 text-xs font-medium" wire:click="ForceDeleteUser( {{ $confirmingForceDeletion }} )" wire:loading.attr="disabled">
                Delete Account
            </x-buttons.danger>
        </x-slot>
    </x-modals.dialog>
</div>
