<div class="mb-6">
    @can('create:post')
        <div class="flex justify-end space-x-2 pb-4">
            <x-link.button href="{{ route('post.create') }}">{{ __('New Post') }}</x-link.button>
        </div>
    @endcan
    @if ($this->posts->count() >1 )
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
            @foreach($this->posts as $post )
                <x-card.blog-item :post="$post"/>
            @endforeach
        </div>
        <div class="pt-4">
            {{ $this->posts->onEachSide(1)->links() }}
        </div>
    @else
        <x-card.default>
            <div class="text-primary-muted flex flex-col items-center gap-2">
                <x-lucide-newspaper class="w-14 h-14 text-secondary"/>
                <p class="text-xl">
                    {{ __('No blog posts found') }}</p>
            </div>
        </x-card.default>
    @endif
</div>
