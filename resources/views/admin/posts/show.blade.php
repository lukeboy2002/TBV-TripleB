<x-app-layout>
    <x-slot name="header">
        <div class="relative w-full">
            <img
                src="{{ asset($post->getImage() )}}"
                class="block w-full h-96 object-center object-cover"
                alt="$slide->title"
            />
            <div class="absolute inset-0 h-full text-center">
                <div class="flex flex-col h-full items-center justify-center">
                    <h5 class="text-2xl font-black text-orange-500 uppercase">Blog post</h5>
                </div>
            </div>
        </div>
    </x-slot>

    <x-cards.default>
        <div class="flex justify-end mb-4">
            @foreach($post->categories as $category)
            <x-badges.default wire:navigate href="#" :Color="$category->color">{{ $category->title }}</x-badges.default>
            @endforeach
        </div>
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ $post->title }}
        </h2>

        <div class="sm:flex items-center sm:space-x-6 sm:mb-4">
            <div class="font-normal text-gray-700 dark:text-gray-400">
                <div class="flex items-center">
                    <img src="{{ asset('storage/' . $post->author->profile_photo_path) }}" class="h-15 w-15 mr-2 rounded-full border dark:border-gray-700" alt="avatar">
    {{--                <x-links.default href="{{ route('explore.show', $post->user->username) }}"--}}
                    <x-links.primary href="#" class="text-gray-900 dark:text-white hover:text-orange-500 dark:hover:text-orange-500 focus:text-orange-500 focus:dark:text-orange-500 focus:underline">{{ $post->author->username }}</x-links.primary>
                </div>
            </div>
            <div class="sm:h-4 flex items-center space-x-4 sm:border-l sm:border-orange-500">
                <div class="ml-0 sm:ml-3 text-xs text-gray-500">
                    <i class="fa-regular fa-clock mr-2"></i>{{ $post->getFormattedDate() }}
                </div>
                <div class="text-xs text-gray-500 py-4">
    {{--                <i class="fa-regular fa-eye mr-2"></i>{{ $post->views->count() }}--}}
                    <i class="fa-regular fa-eye mr-2"></i>2
                </div>
                <div class="text-xs text-gray-500 py-4">
    {{--                <i class="fa-solid fa-comments mr-2"></i>{{ $post->comments->count() }}--}}
                    <i class="fa-solid fa-comments mr-2"></i>12
                </div>
            </div>
        </div>

        <div class="pt-4 text-gray-900 dark:text-white prose prose-orange dark:prose-invert">
            {!! $post->body !!}
        </div>

        <div class="flex justify-end space-x-2">
            @can('update', $post)
                <x-links.btn-secondary
                    href="{{ route('admin.posts.edit' , $post) }}"
                    class="px-2.5 py-2.5 text-xs"><i class="fa-solid fa-pen-to-square mr-2"></i>edit
                </x-links.btn-secondary>
            @endcan
            @can('delete', $post)
                <x-links.btn-secondary href="{{ route('admin.posts.index') }}" class="px-3 py-2.5 text-xs">
                    <i class="fa-solid fa-backward mr-2"></i>back
                </x-links.btn-secondary>
            @endcan
        </div>
    </x-cards.default>

    <x-slot name="side">

    </x-slot>

</x-app-layout>
