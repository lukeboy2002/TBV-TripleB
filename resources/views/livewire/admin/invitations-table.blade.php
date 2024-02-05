<div>
    <x-slot name="header">
        All Members
    </x-slot>

    <div class="flex justify-between items-center space-x-4 pb-4 pt-2">
        <div class="flex items-center">
            <x-search/>
        </div>

    </div>
    @if (!$invitees->isEmpty())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @include('livewire.table.sortable-th',[
                         'name' => 'email',
                          'displayName' => 'Email'
                     ])
                    @include('livewire.table.sortable-th',[
                        'name' => 'invited_by',
                         'displayName' => 'Invited'
                    ])
                    @include('livewire.table.sortable-th',[
                        'name' => 'registered_at',
                         'displayName' => 'Register at'
                    ])
                    <th scope="col" class="px-6 py-3">
                        User active
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($invitees as $invitee)
                    <tr wire:key="{{$invitee->id}}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $invitee->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $invitee->invited_by }}
                        </td>
                        <td class="px-6 py-4">
                            @if($invitee->registered_at)
                                {{ $invitee->getRegisterTime() }}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($invitee->registered_at)
                                <i class="fa-regular fa-circle-check text-green-600 fa-xl"></i>
                            @else
                                <i class="fa-regular fa-circle-xmark text-red-700 fa-xl"></i>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right">
                            @if(isset($invitee->registered_at) == null)
                                @if( ($invitee->invited_by) == current_user()->username || current_user()->hasRole('admin') )
                                <x-buttons.danger class="px-3 py-2.5 text-xs font-medium" wire:click="delete( {{ $invitee->id }})" wire:loading.attr="disabled">
                                    <i class="fa-solid fa-trash-can"></i>
                                </x-buttons.danger>
                                    @endif
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
            {{ $invitees->links() }}
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

            <x-buttons.danger class="px-3 py-2 text-xs font-medium" wire:click="deleteInvitee( {{ $confirmingDeletion }} )" wire:loading.attr="disabled">
                Delete Account
            </x-buttons.danger>
        </x-slot>
    </x-modals.dialog>
</div>
