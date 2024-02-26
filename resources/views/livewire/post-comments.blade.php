<x-cards.default>
    @auth
    <div>
        <label for="comment" class="sr-only">Your comment</label>
        <textarea wire:model="comment"
                  class="w-full p-4 text-sm text-gray-700 dark:text-white border-gray-300 dark:border-gray-500 rounded-lg bg-gray-50 dark:bg-gray-600 focus:outline-none placeholder:text-gray-400"
                  cols="30"
                  rows="1"
                  placeholder="Write a comment...">
        </textarea>

        <x-forms.input-error for="comment" class="mt-2" />
    </div>
    <div class="flex justify-end pt-2">
        <x-buttons.secondary wire:click="postComment" class="px-3 py-2 text-xs font-medium">Post comment</x-buttons.secondary>
    </div>
    @else
        <div class="flex space-x-1">
            <p class="text-xs text-gray-900 dark:text-white">Only users can leave a comment. If you are a user please</p>
            <x-links.primary href="/login">login</x-links.primary>
        </div>
    @endauth

        <div class="px-3 py-2 mt-5 user-comments">
            <ol class="relative border-s border-gray-200 dark:border-gray-700">
            @forelse($this->comments as $comment)
                <li class="mb-10 ms-6">
                    <span class="absolute flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-800 dark:bg-blue-900">
                        <img class="rounded-full shadow-lg" src="{{ $comment->user->profile_photo_path }}" alt="{{ $comment->user->username }}"/>
                    </span>
                    <div class="ml-1 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                        <div class="items-center justify-between mb-3 sm:flex">
                            <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{ $comment->created_at->diffForHumans() }}</time>
                            <div class="text-sm font-normal text-gray-500 lex dark:text-gray-300">{{ $comment->user->username }}</div>
                        </div>
                        <div class="p-3 text-xs font-normal text-gray-900 dark:text-white">
                            {{ $comment->comment }}
                        </div>
                    </div>
                </li>
                {{--                <div class="comment [&:not(:last-child)]:border-b border-gray-100 py-5">--}}
{{--                    <div class="flex items-center mb-4 text-sm user-meta">--}}
{{--                        <div>--}}
{{--                            <img class="mr-3 rounded-full h-8 w-8" src="{{ $comment->user->profile_photo_path }}" alt="{{ $comment->user->username }}">--}}
{{--                            <span class="mr-1">{{ $comment->user->username }} </span>--}}
{{--                        </div>--}}
{{--                        <x-posts.author :author="$comment->user" size="sm" />--}}
{{--                        <span class="text-gray-500">. {{ $comment->created_at->diffForHumans() }}</span>--}}
{{--                    </div>--}}
{{--                    <div class="text-sm text-justify text-gray-700">--}}
{{--                        {{ $comment->comment }}--}}
{{--                    </div>--}}
{{--                </div>--}}
            @empty
            </ol>
                <div class="text-center text-gray-500">
                    <span> No Comments Posted</span>
                </div>
            @endforelse
        </div>
        <div class="my-2">
            {{ $this->comments->links() }}
        </div>
</x-cards.default>
