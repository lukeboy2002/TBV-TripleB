<div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
        @foreach($this->posts as $post )
            <x-card.blog-item :post="$post"/>
        @endforeach
    </div>
    <div class="pt-4">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>