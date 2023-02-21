<div>
    @foreach($posts as $post)
        <div class="mb-6">
            <div class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white">
                <a href="/posts/{{ $post->slug }}">
                    {{ $post->title }}
                </a>
                <div class="text-xs text-gray-500 py-4 border-b border-gray-700 flex justify-between">
                    <div>
                        <i class="fa-regular fa-clock mr-2"></i>{{ $post->created_at->format('d F Y') }}
                    </div>
                    <div class="hidden md:block">
                        <i class="fa-regular fa-user mr-2"></i>{{ $post->author->username }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

