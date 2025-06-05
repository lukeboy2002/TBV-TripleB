<div class="flex items-center gap-4">
    @auth
        @if($isLiked)
            <button wire:click="toggleLike"
                    class="inline-flex items-center px-2 py-1 bg-button-secondary border border-transparent rounded-md font-semibold text-xs text-danger uppercase tracking-widest hover:border-border/30 focus:border-border/30 active:border-border/30 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                <x-lucide-thumbs-down class="h-3 w-3"/>
            </button>
        @else
            <button wire:click="toggleLike"
                    class="inline-flex items-center px-2 py-1 bg-button-secondary border border-transparent rounded-md font-semibold text-xs text-success uppercase tracking-widest hover:border-border/30 focus:border-border/30 active:border-border/30 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                <x-lucide-thumbs-up class="h-3 w-3"/>
            </button>
        @endif
    @endauth
    @if($likeable->likes_count == 0)
        <div class="text-edit text-xs text-nowrap flex gap-1">{{ $likeable->likes_count }}
            <x-lucide-thumbs-up class="h-3 w-3"/>
        </div>
    @elseif($isLiked)
        <div class="text-success text-xs text-nowrap flex gap-1">{{ $likeable->likes_count }}
            <x-lucide-thumbs-up class="h-3 w-3"/>
        </div>
    @else
        <div class="text-danger text-xs text-nowrap flex gap-1">{{ $likeable->likes_count }}
            <x-lucide-thumbs-up class="h-3 w-3"/>
        </div>
    @endif
</div>