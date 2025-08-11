<x-app-layout title="Home">
    <x-slot name="hero">
        <div class="relative w-full">
            <img src="{{ asset('storage/assets/members.jpg' )}}" class="block w-full object-center object-cover"
                 alt="team"/>
        </div>
    </x-slot>

    <div>
        @if(!$featuredPosts->isEmpty())
            <div class="mb-6">
                <x-heading.sub>Featured posts</x-heading.sub>
                <x-card.default>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
                        @foreach($featuredPosts as $post)
                            <x-card.blog-featured :post="$post"/>
                        @endforeach
                    </div>
                </x-card.default>
            </div>
        @endif
        <div>
            <x-heading.sub>Latest posts</x-heading.sub>
            <x-card.default>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
                    @foreach($latestPosts as $post)
                        <x-card.blog-featured :post="$post"/>
                    @endforeach
                </div>
            </x-card.default>
        </div>
    </div>

    <x-slot name="side">
        <div class="w-full flex flex-col gap-6 md:gap-12">
            <livewire:games.cup-winner/>
            <livewire:games.latest-game/>
            <livewire:albums.latest-album-image/>
        </div>

    </x-slot>
</x-app-layout>