<div class="p-4 rounded-lg shadow">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-divide/30">
            <thead class="bg-background">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider cursor-pointer" wire:click="sortBy('email')">
                    Email
                    @if($sortField === 'email')
                        <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                    @endif
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider cursor-pointer" wire:click="sortBy('invited_by')">
                    Invited By
                    @if($sortField === 'invited_by')
                        <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                    @endif
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider cursor-pointer" wire:click="sortBy('invited_date')">
                    Invited Date
                    @if($sortField === 'invited_date')
                        <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                    @endif
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider cursor-pointer" wire:click="sortBy('registered_at')">
                    Status
                    @if($sortField === 'registered_at')
                        <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                    @endif
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-divide/30">
            @forelse($invitations as $invitation)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                        {{ $invitation->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                        {{ $invitation->invitedBy ? $invitation->invitedBy->username : 'Unknown' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                        {{ $invitation->invited_date ? $invitation->getInvitationDate() : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($invitation->registered_at)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Registered ({{ $invitation->getRegisterTime() }})
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                        @if(!$invitation->registered_at && (auth()->user()->hasRole('admin') || auth()->user()->id === $invitation->invited_by))
                            <button wire:click="deleteInvitation({{ $invitation->id }})" 
                                    class="text-red-600 hover:text-red-900"
                                    onclick="return confirm('Are you sure you want to delete this invitation?')">
                                Delete
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-primary">
                        No invitations found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
