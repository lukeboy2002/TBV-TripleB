<div>
    <x-heading.sub>All Invitees</x-heading.sub>
    <x-card.default>
        <div class="relative overflow-x-auto shadow-md rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-primary-muted border border-secondary/30">
                <thead class="text-xs text-primary bg-background-hover">
                <tr>
                    @include('livewire.components.sortable-th',[
                        'name' => 'email',
                         'displayName' => __('Email')
                    ])
                    @include('livewire.components.sortable-th',[
                        'name' => 'invited_by',
                         'displayName' => __('Invited by')
                    ])
                    <th scope="col" class="px-6 py-3">
                        {{ __('Invited at') }}
                    </th>
                    {{--                    <th scope="col" class="px-6 py-3">--}}
                    {{--                        {{ __('Registered at') }}--}}
                    {{--                    </th>--}}
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{{ __('Actions') }}</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @if ( !$user->registered_at)
                        <tr wire:key="{{$user->id}}" class="bg-transparent border-b border-secondary/30 ">
                            <td class="px-6 py-4 font-medium whitespace-nowrap ">
                            <span class="{{ $user->registered_at ? 'text-success' : 'text-primary-muted' }}">
                                {{ $user->email }}
                            </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->invitedBy->username ?? 'Unknown' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->getInvitationDate() }}
                            </td>
                            {{--                            <td class="px-6 py-4">--}}
                            {{--                                {{ $user->registered_at }}--}}
                            {{--                            </td>--}}
                            <td class="py-4 text-right">
                                <div class="flex space-x-2 mr-2">
                                    @if ( !$user->registered_at)
                                        @if ( auth()->user()->can('delete', $user))
                                            <x-button.icon wire:click="deleteUser({{ $user->id }})"
                                                           class="text-error"
                                                           icon="trash"/>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
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
                                {{ __('Delete Invitation') }}
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
                            <h3 class="mb-5 text-lg font-normal text-primary-muted">{{ __('Are you sure you want to delete this invitation?') }}</h3>
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
