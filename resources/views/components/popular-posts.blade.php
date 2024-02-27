<x-theme.heading>Popular Posts</x-theme.heading>
<div class="mt-4">
    <div class="mb-4 justify-end">
        @foreach($popularPosts as $post)
            @props(['post'])

            <div class="w-full mb-2 p-2 border border-gray-700 dark:border-gray-700 rounded-lg">
                <div class="flex justify-end items-center mb-4 text-xs text-gray-500">
                    <div class="flex space-x-2">
                        <x-icons name="clock" />{{ $post->published_at->diffForHumans() }}
                    </div>
                    <div class="flex space-x-2">
                        <x-icons name="thumb-up" />{{ $post->like_count }}
                    </div>
                </div>
                <a href="{{ route('posts.show', $post->slug) }}">
                    <h3 class="text-md font-bold tracking-tight text-gray-900 dark:text-white">{{$post->title}}</h3>
                </a>
                <div class="my-3 text-xs font-normal text-gray-700 dark:text-gray-400">
                    {!! $post->shortBody(20) !!}
                </div>

            </div>
        @endforeach
    </div>
</div>