<div>
    <div class="flex justify-end items-center mb-2">
        <x-form.input wire:model.live.debounce.300ms="search"
                      type="text"
                      name="search"
                      id="search"
                      icon="search"
                      placeholder="Search..."
                      class="ml-2"
        />
    </div>

    <x-heading.sub>Pending invitations</x-heading.sub>
    <x-card.default>

        <div class="relative overflow-x-auto shadow-md rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-primary-muted border border-secondary/30">
                <thead class="text-xs text-primary bg-background-hover">
                <tr>
                    @include('livewire.sortable-th',[
                        'name' => 'email',
                         'displayName' => 'Email'
                    ])
                    @include('livewire.sortable-th',[
                        'name' => 'invited_by',
                         'displayName' => 'Invited'
                    ])
                    @include('livewire.sortable-th',[
                        'name' => 'invited_date',
                         'displayName' => 'Invited'
                    ])
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr wire:key="{{$user->id}}" class="bg-transparent border-b border-secondary/30 ">
                        <td class="px-6 py-4 font-medium whitespace-nowrap ">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->invitedBy->username ?? 'Unknown' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->getInvitationDate() }}
                        </td>

                        <td class="py-4 text-right">
                            {{--                        TODO: edit user and delete only bij member how invited this user or admin--}}
                            <div class="flex space-x-2 mr-2">
                                @if ( auth()->user()->can('delete', $user))
                                    {{--                            @if(!$user->registered_at && (auth()->user()->hasRole('admin') || auth()->user()->id === $user->invited_by))--}}
                                    <x-button.icon wire:click="deleteUser({{ $user->id }})"
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
        <div class="px-4 py-4">
            {{ $users->links() }}
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
                                Delete User
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
                                want to delete this user</h3>
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
</div>