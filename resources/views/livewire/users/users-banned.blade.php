<x-card.side>
    <x-slot name="header">
        {{ __('Banned') }} ({{ count($bannedUsers) }})
    </x-slot>
    @if(count($bannedUsers))
        @foreach($bannedUsers as $banned)
            <div class="text-lg font-extrabold text-primary py-2 {{ !$loop->last ? 'border-b border-secondary/30' : '' }}">
                <div class="flex items-center justify-between">
                    <div class="truncate">
                        <span class="font-medium">{{ $banned->username }}</span>
                        <span class="ml-2 text-xs text-primary-muted">{{ $banned->name }}</span>
                    </div>
                    <button
                            type="button"
                            wire:click="unban({{ $banned->id }})"
                            class="text-xs px-2 py-0.5 rounded bg-green-100 text-green-700 hover:bg-green-200"
                            title="Unban user"
                    >
                        unban
                    </button>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-primary-muted flex flex-col items-center gap-2">
            <x-lucide-user-x class="w-14 h-14 text-secondary"/>
            <p class="text-xl">
                {{ __('No users are banned') }}</p>
        </div>
    @endif
</x-card.side>
