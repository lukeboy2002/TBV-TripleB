<div>
    <div class="mb-6">
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
                <div class="px-4 py-4 text-secondary font-bold text-xl">
                    Nog geen blog posts gevonden.
                </div>
            </x-card.default>
        @endif
    </div>
</div>