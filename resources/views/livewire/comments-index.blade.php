<div>
    <x-tbv-heading_h2><span class="text-secondary">{{ $commentsCount }}</span> Comments</x-tbv-heading_h2>

    <livewire:comment-create :post="$post"/>

    @if (!$comments->isEmpty())
        @foreach($comments as $comment)
            <livewire:comment-item :comment="$comment"
                                   wire:key="comment-{{$comment->id}}"/>
        @endforeach
        <div class="pt-4">
            {{ $comments->links() }}
        </div>
    @else
        <p class="text-primary text-sm p-4">No comments</p>
    @endif


</div>
