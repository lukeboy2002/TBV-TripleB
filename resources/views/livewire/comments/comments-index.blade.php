<div class="pt-4">
    <x-heading.sub>{{ __('Comments') }} - ({{ $commentsCount }})</x-heading.sub>

    <livewire:comments.comment-create :post="$post"/>

    <x-card.default>
        @if (!$comments->isEmpty())
            @foreach($comments as $comment)
                <livewire:comments.comment-item
                        :comment="$comment"
                        wire:key="comment-{{ $comment->id }}"/>
            @endforeach
            <div class="pt-4">
                {{ $comments->links() }}
            </div>
        @else
            <div class="text-primary-muted flex flex-col items-center gap-2">
                <x-lucide-message-circle-x class="w-14 h-14 text-secondary"/>
                <p class="text-xl">
                    {{ __('No comments yet') }}</p>
            </div>
        @endif
    </x-card.default>
</div>
