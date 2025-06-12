<x-app-layout title="{{ $post->title }}">

    <x-tbv-heading_h1>{{ $post->title }}</x-tbv-heading_h1>
    <div class="mx-auto flex max-w-7xl flex-wrap py-4 bg-background/80 rounded-lg">
        <div class="flex w-full flex-col px-3 md:w-3/4">
            <header class="block overflow-hidden">
                <img class="rounded-lg w-full  object-cover"
                     src="{{ Storage::url($post->image) }}"
                     alt="{{ $post->title }}"/>
            </header>
            <main>
                <div class="flex justify-between py-4">
                    <div class="flex items-center text-primary text-xs gap-x-1">
                        <img class="size-8 rounded-full object-cover mr-2"
                             src="{{ $post->author->profile_photo_url }}"
                             alt="{{ $post->author->username }}"/>
                        <div> by <a href="#" class="text-secondary">{{ $post->author->username }}</a> at</div>
                        <div> {{ $post->getFormattedDate() }}</div>
                    </div>
                    <div class="flex items-center text-primary text-xs gap-x-1">
                        <livewire:post-actions :post="$post"/>
                        <x-tbv-badge-category :color="$post->category->color" class="rounded-l-lg">
                            {{ $post->category->name }}
                        </x-tbv-badge-category>
                    </div>
                </div>

                <div class="content">
                    {!! $post->body !!}
                </div>
            </main>
            <footer class="bg-neutral-800 mt-6 h-16 rounded-lg flex items-center justify-between px-6">
                <div class="flex gap-2">
                    <div class="font-bold uppercase mr-2">Share article:</div>
                    <x-tbv-button_icon type="button" icon="facebook"
                                       class="bg-neutral-200 text-neutral-950 hover:bg-secondary hover:text-neutral-200 focus:outline-none focus:bg-secondary focus:text-neutral-200"/>
                    <x-tbv-button_icon type="button" icon="linkedin"
                                       class="bg-neutral-200 text-neutral-950 hover:bg-secondary hover:text-neutral-200 focus:outline-none focus:bg-secondary focus:text-neutral-200"/>
                    <x-tbv-button_icon type="button" icon="instagram"
                                       class="bg-neutral-200 text-neutral-950 hover:bg-secondary hover:text-neutral-200 focus:outline-none focus:bg-secondary focus:text-neutral-200"/>
                    <x-tbv-button_icon type="button" icon="x"
                                       class="bg-neutral-200 text-neutral-950 hover:bg-secondary hover:text-neutral-200 focus:outline-none focus:bg-secondary focus:text-neutral-200"/>
                </div>
                @auth()
                    <livewire:likes type="post" id="{{ $post->id }}"/>
                @endauth
            </footer>
            <div class="pt-4">

                <livewire:comments-index :post="$post"/>
            </div>
        </div>

        <aside class="hidden md:flex w-full flex-col px-3 md:w-1/4 gap-4">
            <x-category/>

            <div class="rounded-lg bg-background-accent shadow-xs ring-1 ring-ring/30 p-2">
                <x-tbv-heading_h5>Tags</x-tbv-heading_h5>
                <livewire:tag-manager :model="$post"/>
            </div>
        </aside>
    </div>
</x-app-layout>