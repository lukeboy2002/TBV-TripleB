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
                    <h5 class="text-2xl font-black text-orange-500 uppercase">{{ $post->title }}</h5>
                </div>
            </div>
        </div>
    </x-slot>

    <x-cards.default>
        <div class="flex justify-end mb-4">
            @foreach($post->categories as $category)
                <x-badges.default wire:navigate href="{{ route('posts.index', ['category' => $category->slug]) }}" :Color="$category->color">{{ $category->title }}</x-badges.default>
            @endforeach
        </div>
        <h2 class="mb-2 text-xl text-gray-900 dark:text-white">
            {{ $post->title }}
        </h2>

        <div class="sm:flex justify-between items-center sm:space-x-6 sm:mb-4">
            <div class="font-normal text-gray-700 dark:text-gray-400">
                <div class="flex">
                    <div class="flex items-center">
                    <img src="{{ asset('storage/' . $post->author->profile_photo_path) }}" class="h-15 w-15 mr-2 rounded-full border dark:border-gray-700" alt="avatar">
{{--                    <x-links.default href="{{ route('explore.show', $post->user->username) }}"--}}
                    <x-links.primary href="#" class="text-gray-900 dark:text-white hover:text-orange-500 dark:hover:text-orange-500 focus:text-orange-500 focus:dark:text-orange-500 focus:underline">{{ $post->author->username }}</x-links.primary>
                    </div>
                        <div class="flex items-center">
                        <x-icons name="clock" />{{ $post->getFormattedDate() }}
                    </div>
                </div>
            </div>
            <div class="sm:h-4 text-sm flex items-center space-x-2 text-gray-500">
                <div class="flex items-center">
                    {{--            {{ $post->comments->count() }}--}}
                    <x-icons name="view" />10
                </div>
                <div class="flex items-center">
                    {{--            {{ $post->comments->count() }}--}}
                    <x-icons name="comment" />10
                </div>
                <div class="flex items-center">
                    <x-icons name="reading" />{{ $post->getReadingTime() }} min
                </div>
                <div class="flex items-center">
                    <livewire:like-button :key="$post->id" :post="$post" />
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
        </div>
    </x-cards.default>

    <x-slot name="side">
        <x-theme.heading>Most likes</x-theme.heading>
        <x-theme.heading>Categories</x-theme.heading>
    </x-slot>
</x-app-layout>
