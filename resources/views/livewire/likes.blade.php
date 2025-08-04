<div class="flex items-center gap-4">
    @auth
        @if(!$isCreator)
            @if($isLiked)
                <x-button.icon wire:click="toggleLike" icon="thumbs-down" class="text-error"/>
            @else
                <x-button.icon wire:click="toggleLike" icon="thumbs-up" class="text-success"/>
            @endif
        @endif
    @endauth

    @if($likeable->likes_count == 0)
        <div class="text-primary-muted flex items-center gap-1 text-xs">
            0 likes
        </div>
        {{--    @elseif($isLiked)--}}
        {{--        <div class="text-success flex item-center gap-1">--}}
        {{--            <div>{{ $likeable->likes_count }}</div>--}}
        {{--            <x-lucide-thumbs-up class="h-4 w-4"/>--}}
        {{--        </div>--}}
    @else
        <div class="text-success flex item-center gap-1 text-xs">
            <div>{{ $likeable->likes_count }}</div>
            likes
        </div>
    @endif
</div>