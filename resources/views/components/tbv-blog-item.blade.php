<x-tbv-card>
    <x-slot name="header">
        <a href="{{ route('post.show', $post->slug) }}" class="block overflow-hidden">
            <img class="rounded-lg w-full max-h-48 object-cover transition-transform duration-300 hover:scale-110"
                 src="{{ Storage::url($post->image) }}"
                 alt="{{ $post->title }}"/>
        </a>
        <div class="absolute top-4 left-0">
            <x-tbv-badge-category :color="$post->category->color">
                {{ $post->category->name }}
            </x-tbv-badge-category>
        </div>
    </x-slot>
    <a href="{{ route('post.show', $post->slug) }}"
       class="mb-2 text-xl font-bold tracking-tight text-primary">{{ $post->title }}</a>
    <div class="flex flex-col gap-4 pt-4">
        <div class="flex items-center text-primary text-xs gap-x-1">
            <img class="size-8 rounded-full object-cover mr-2"
                 src="{{ $post->author->profile_photo_url }}"
                 alt="{{ $post->author->username }}"/>
            <div> by <a href="#" class="text-secondary">{{ $post->author->username }}</a> at</div>
            <div> {{ $post->getFormattedDate() }}</div>
        </div>
        <div class="text-primary text-sm">
            {!! $post->shortBody() !!}
        </div>
    </div>
    <x-slot name="footer">
        <a class="px-3 py-2 text-xs font-medium text-center text-primary bg-secondary rounded-lg hover:bg-secondary/60 focus:ring-4 focus:outline-none focus:ring-ring"
           href="{{ route('post.show', $post->slug)  }}">
            Read More
        </a>
    </x-slot>
</x-tbv-card>