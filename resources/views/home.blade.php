<x-app-layout>

    <div class="w-full mb-10">
        <div class="My-8">
            <x-theme.heading>In the spotlight</x-theme.heading>
            <div class="w-full py-4">
                <div class="grid w-full grid-cols-1 gap-10">
                    @foreach ($featuredPosts as $post)
                        <x-cards.post :post="$post" class="col-span-3 md:col-span-1" />
                    @endforeach
                </div>
            </div>
            <div class="flex justify-end items-center">
                <x-links.btn-secondary wire:navigate href="{{ route('posts.index') }}" class="px-3 py-2 text-xs font-medium">
                    more posts
                </x-links.btn-secondary>
            </div>
        </div>

        <div class="mb-16">
            <x-theme.heading>Latest Post</x-theme.heading>
            <div class="w-full py-4">
                <div class="grid w-full grid-cols-2 gap-10">
                    @foreach ($latestPosts as $post)
                        <x-cards.post :post="$post" class="col-span-3 md:col-span-1" />
                    @endforeach
                </div>
            </div>
            <div class="flex justify-end items-center">
                <x-links.btn-secondary wire:navigate href="{{ route('posts.index') }}" class="px-3 py-2 text-xs font-medium">
                    more posts
                </x-links.btn-secondary>
            </div>
        </div>

{{--        <h2 class="mt-16 mb-5 text-3xl font-bold text-yellow-500">{{ __('home.latest_posts') }}</h2>--}}
{{--        <div class="w-full mb-5">--}}
{{--            <div class="grid w-full grid-cols-3 gap-10">--}}
{{--                @foreach ($latestPosts as $post)--}}
{{--                    <x-cards.post :post="$post" class="col-span-3 md:col-span-1" />--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <a class="block mt-10 text-lg font-semibold text-center text-yellow-500" href="{{ route('posts.index') }}">--}}
{{--            {{ __('home.more_posts') }}--}}
{{--        </a>--}}
    </div>
    <x-slot name="side">
        saljf
    </x-slot>
</x-app-layout>
