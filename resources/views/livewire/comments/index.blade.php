<div class="mt-4">
    <x-heading.sub>Comments ({{ $commentsCount }})</x-heading.sub>
    
    <livewire:comments.create :post="$post"/>

    <x-card.default>
        @if (!$comments->isEmpty())
            @foreach($comments as $comment)
                <livewire:comments.item :comment="$comment"
                                        wire:key="comment-{{$comment->id}}"/>
            @endforeach
            <div class="pt-4">
                {{ $comments->links() }}
            </div>
        @else
            <p class="text-primary text-sm p-4">No comments</p>
        @endif
    </x-card.default>
</div>
