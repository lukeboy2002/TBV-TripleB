<section class="antialiased [&:not(:first-child)]:border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4">
        <article class="px-6 py-3">
            <header class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                        <img class="mr-2 w-6 h-6 rounded-full" src="{{ $comment->user->profile_photo_path }}" alt="{{ $comment->user->username }}">
                        {{ $comment->user->username }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <time pubdate datetime="2022-02-08" title="February 8th, 2022">{{ $comment->created_at->format('d M Y, H:m:s') }}</time>
                    </p>
                </div>
            </header>
            @if($editing)
                <livewire:comment-create :comment-model="$comment"/>
            @else
                <div class="text-gray-500 dark:text-gray-400">
                    {{$comment->comment}}
                </div>
            @endif
            <div class="flex items-center mt-4 space-x-4">
                <a wire:click.prevent="startReply" href="#" class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                    <i class="fa-solid fa-comment-dots mr-2"></i>Reply
                </a>
                @if (\Illuminate\Support\Facades\Auth::id() == $comment->user_id)
                    <a wire:click.prevent="startCommentEdit" href="#" class="flex items-center text-sm text-green-500 hover:underline font-medium">
                        <i class="fa-solid fa-pen-to-square mr-2"></i>Edit
                    </a>
                    <a wire:click.prevent="deleteComment" href="#" class="flex items-center text-sm text-red-500 hover:underline font-medium">
                        <i class="fa-solid fa-trash-can mr-2"></i>Delete
                    </a>
                @endif
            </div>
            @if ($replying)
                <div class="pt-4">
                    <livewire:comment-create :post="$comment->post" :parent-comment="$comment"/>
                </div>
            @endif
        </article>
        @if ($comment->comments->count())
            @foreach($comment->comments as $childComment)
                <div class="ml-6">
                    <livewire:comment-item :comment="$childComment" wire:key="comment-{{$childComment->id}}"/>
                </div>
{{--                <article class="p-6 mb-3 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900">--}}
{{--                    <footer class="flex justify-between items-center mb-2">--}}
{{--                        <div class="flex items-center">--}}
{{--                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img--}}
{{--                                        class="mr-2 w-6 h-6 rounded-full"--}}
{{--                                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"--}}
{{--                                        alt="Jese Leos">Jese Leos</p>--}}
{{--                            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-12"--}}
{{--                                                                                      title="February 12th, 2022">Feb. 12, 2022</time></p>--}}
{{--                        </div>--}}
{{--                    </footer>--}}
{{--                    <p class="text-gray-500 dark:text-gray-400">Much appreciated! Glad you liked it ☺️</p>--}}
{{--                    <div class="flex items-center mt-4 space-x-4">--}}
{{--                        <button type="button"--}}
{{--                                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">--}}
{{--                            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">--}}
{{--                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>--}}
{{--                            </svg>--}}
{{--                            Reply--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </article>--}}
            @endforeach
        @endif
    </div>
</section>