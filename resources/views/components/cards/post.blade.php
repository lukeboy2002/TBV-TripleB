@props(['post'])
    <article {{ $attributes->merge(['class' => 'flex flex-col bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700']) }}>
        <div class="relative">
            <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
                <img class="mx-auto h-52 w-full object-cover rounded-t-lg" src="{{ asset($post->getImage() )}}" alt="{{ $post->title }}">
            </a>
            <div class="absolute bg-orange-500 block h-16 mr-4 right-0 text-center text-lg text-white top-0 w-16">
                <p class="text-3xl font-extrabold">{{ $post->published_at->format('d') }}</p>
                <p class="text-sm">{{ $post->published_at->format('M') }}</p>
            </div>
        </div>
        <div class="p-3">
            <div class="mb-4 flex justify-end">
                @foreach($post->categories as $category)
                    <x-badges.default wire:navigate href="{{ route('posts.index', ['category' => $category->slug]) }}" :Color="$category->color">{{ $category->title }}</x-badges.default>
                @endforeach
            </div>
            <div class="mb-4">
                <a wire:navigate href="{{ route('posts.show', $post->slug) }}" class="font-bold text-2xl text-gray-900 dark:text-white hover:text-orange-500 dark:hover:text-orange-500 focus:outline-none focus:text-orange-500 dark:focus:text-orange-500 transition duration-150 ease-in-out">
                    {{ $post->title }}
                </a>
            </div>
            <div class="mb-4 flex flex-wrap font-normal text-gray-700 dark:text-gray-400">
                {!! $post->shortBody() !!}
            </div>
        </div>
        <footer class="hidden sm:flex flex-wrap justify-end items-center space-x-4 mt-auto p-3 text-xs text-gray-500">
            <div>
                <i class="fa-regular fa-clock mr-1"></i>{{ $post->published_at->diffforhumans() }}
            </div>
            <div>
                <i class="fa-regular fa-user mr-1"></i>{{ $post->author->username }}
            </div>
            <div>
{{--                <i class="fa-solid fa-comments ml-4 mr-2"></i>{{ $post->comments->count() }}--}}
                <i class="fa-solid fa-eye mr-1"></i>10
            </div>
            <div>
{{--                <i class="fa-solid fa-comments ml-4 mr-2"></i>{{ $post->comments->count() }}--}}
                <i class="fa-solid fa-comments mr-1"></i>10
            </div>
            <div>
                <i class="fa-solid fa-glasses mr-1"></i>{{ $post->getReadingTime() }} min
            </div>
        </footer>
    </article>
