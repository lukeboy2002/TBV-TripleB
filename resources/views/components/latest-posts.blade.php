<div>
    @foreach($latestPosts as $post)
    <div class="flex mb-2 space-x-2">
        <div class="w-1/3">
            <img class="h-20 object-cover" src="{{ asset($post->getImage() )}}" alt="{{ $post->title }}">
        </div>
        <div class="w-2/3">
            <x-links.primary wire:navigate href="{{ route('posts.show', $post->slug) }}">
                {{ $post->title }}
            </x-links.primary>
        </div>
    </div>
    @endforeach
</div>
