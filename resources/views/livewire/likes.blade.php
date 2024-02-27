<div class="flex space-x-2">
    <button wire:click="upvoteDownvote(true)" class="flex gap-2 items-center hover:text-orange-500 transition-all {{$hasUpvote ? 'text-green-500' : ''}}">
        <x-icons name="thumb-up" />{{ $upvotes }}
    </button>

    <button wire:click="upvoteDownvote(false)" class="flex gap-2 items-center hover:text-orange-500 transition-all {{$hasUpvote === false ? 'text-red-500' : ''}}">
        <x-icons name="thumb-down" />{{ $downvotes }}
    </button>
</div>
