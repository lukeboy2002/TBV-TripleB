<!-- resources/views/livewire/messages.blade.php -->
<div>
    <div class="bg-background/80 rounded-lg p-4">
        <div class="flex border-b border-border mb-4">
            <button
                    wire:click="setTab('inbox')"
                    class="px-4 py-2 {{ $activeTab === 'inbox' ? 'border-b-2 border-secondary text-secondary' : 'text-primary' }}">
                Inbox
                <span class="ml-1 relative">
                    <livewire:unread-message-count />
                </span>
            </button>
            <button
                    wire:click="setTab('sent')"
                    class="px-4 py-2 {{ $activeTab === 'sent' ? 'border-b-2 border-secondary text-secondary' : 'text-primary' }}">
                Sent
            </button>
        </div>

        <div class="space-y-4">
            @forelse($messages as $message)
                <div wire:key="message-{{ $message->id }}"
                     class="p-4 rounded-lg border {{ !$message->is_read && $activeTab === 'inbox' ? 'bg-secondary/10 border-secondary' : 'border-border' }}">
                    <div class="flex justify-between items-start">
                        <div>
                            @if($activeTab === 'inbox')
                                <p class="font-semibold">From: {{ $message->sender->username }}</p>
                            @else
                                <p class="font-semibold">To: {{ $message->recipient->username }}</p>
                            @endif
                            <p class="text-xs text-primary-muted">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                        @if($activeTab === 'inbox' && !$message->is_read)
                            <button wire:click="markAsRead({{ $message->id }})"
                                    class="text-xs text-secondary hover:underline">
                                Mark as read
                            </button>
                        @endif
                    </div>
                    <div class="mt-2">
                        <p>{{ $message->content }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-primary-muted">
                    No messages found.
                </div>
            @endforelse

            <div class="mt-4">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>
