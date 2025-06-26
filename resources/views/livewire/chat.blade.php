<div class="mx-auto max-w-7xl flex-wrap bg-background/80 rounded-lg p-4">
    <div class="flex h-[550px] text-sm border border-border rounded-lg shadow overflow-hidden bg-background-accent">
        {{-- Gebruikerskolom --}}
        <div class="w-1/4 border-r border-border bg-background-accent">
            <div class="p-4 font-bold text-primary-muted border-b">Users</div>
            <div class="divide-y h-[520px] overflow-y-auto">
                @foreach($users as $user)
                    <div wire:click="selectUser({{ $user->id }})"
                         class="p-3 cursor-pointer hover:bg-background transition {{ $selectedUser->id === $user->id ? 'bg-background text-base font-extrabold' : '' }}">
                        <div class="text-secondary">{{ ucfirst($user->username) }}</div>
                        <div class="text-xs text-primary-muted">{{ $user->name }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Chatgedeelte --}}
        <div class="w-3/4 flex flex-col">
            {{-- Header --}}
            <div class="p-4 border-b">
                <div class="text-lg font-bold text-secondary">{{ ucfirst($selectedUser->username) }}</div>
                <div class="text-xs text-primary-muted">{{ $selectedUser->name }}</div>
            </div>

            {{-- Berichten --}}
            <div class="flex-1 p-4 overflow-y-auto space-y-2">
                @foreach($messages as $message)
                    <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs px-4 py-2 rounded-2xl shadow-lg {{ $message->sender_id === auth()->id() ? 'bg-secondary text-primary' : 'bg-background text-primary' }} ">
                            {{ $message->message}}
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Input --}}
            <form wire:submit="sentMessage" class="p-4 border-t flex items-center gap-2">
                <x-tbv-input wire:model="newMessage"
                             class="w-full"
                             placeholder="Type a message"/>
                <x-tbv-button type="submit">Send</x-tbv-button>
            </form>
        </div>
    </div>
</div>