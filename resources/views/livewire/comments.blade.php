<x-cards.default>
    <livewire:comment-create :post="$post" />

    @if (!$comments->isEmpty())
    @foreach($comments as $comment)
        <livewire:comment-item :comment="$comment" wire:key="comment-{{$comment->id}}-{{$comment->comments->count()}}" />
    @endforeach
    <div class="py-4 px-3">
        <x-items-per-page/>
    </div>
    <div class="pt-4">
        {{ $comments->links() }}
    </div>
    @else
        <p class="text-gray-700 dark:text-white">No comments</p>
    @endif
</x-cards.default>