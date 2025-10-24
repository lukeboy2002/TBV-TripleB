<div class="flex items-center gap-4">
    @auth
        @if(!$isAuthor)
            @if($isLiked)
                <x-button.icon wire:click="toggleLike" icon="thumbs-down" class="text-error"/>
            @else
                <x-button.icon wire:click="toggleLike" icon="thumbs-up" class="text-success"/>
            @endif
        @endif
    @endauth
    <x-like>{{ $likeable->likes_count }}</x-like>
</div>