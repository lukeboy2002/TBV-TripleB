<x-theme.heading>Categories</x-theme.heading>
<div class="mt-4">
    <div class="mb-4 justify-end">
        @foreach($categories as $category)
            <x-badges.default wire:navigate href="{{ route('posts.index', ['category' => $category->slug]) }}" :Color="$category->color">{{ $category->title }}</x-badges.default>
        @endforeach
    </div>
</div>
