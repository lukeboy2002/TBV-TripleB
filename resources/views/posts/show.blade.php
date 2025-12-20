<x-app-layout title="Blog">

    <x-heading.main>{{ $post->title }}</x-heading.main>

    <x-card.blog>
        <x-slot name="header">

            <img class="rounded-t-lg h-[30rem] min-h-full w-full object-cover"
                 src="{{ asset('storage/'. $post->featured_image) }}"
                 alt="{{ $post->title }}"/>

            <livewire:posts.post-stats :post="$post"/>
        </x-slot>
        <div class="flex justify-between px-4 pb-4">
            <div class="flex items-center text-primary text-xs gap-x-1">
                <img class="size-8 rounded-full object-cover mr-2"
                     src="{{ $post->author->profile_photo_url }}"
                     alt="{{ $post->author->username }}"/>
                <div>
                    {{ __('By') }}
                    <span class="text-secondary">{{ ucfirst($post->author->username) }}</span>
                    {{ __('published on') }}
                </div>
                <div> {{ $post->getFormattedDate() }}</div>
            </div>
            <div class="flex items-center text-primary text-xs gap-x-1">
                <livewire:actions.post-actions :post="$post"/>

                <x-badge.category :color="$post->category->color" class="rounded-l-lg">
                    {{ $post->category->name }}
                </x-badge.category>
            </div>
        </div>
        <div class="px-4 pb-2">
            @if($post->tags && $post->tags->isNotEmpty())
                <div class="flex flex-wrap gap-2 items-center">
                    @foreach($post->tags as $tag)
                        <a href="{{ route('posts.index', ['tag' => $tag->name]) }}"
                           class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary hover:bg-secondary/20 hover:text-secondary transition">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="prose prose-orange dark:prose-invert text-primary px-4 max-w-7xl">
            {!! $post->body !!}
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-between px-6 bg-background-hover rounded-lg py-4">
                <div class="flex items-center gap-x-2 text-primary">
                    <div class="font-bold uppercase mr-2">Share:</div>
                    <x-link.icon
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url(route('posts.show', $post->slug, false))) }}"
                            icon="facebook"
                            target="_blank"
                            rel="noopener noreferrer"
                    />
                    <x-link.icon
                            href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url(route('posts.show', $post->slug, false))) }}"
                            icon="linkedin"
                            target="_blank"
                            rel="noopener noreferrer"
                    />
                    <x-link.icon
                            href="https://twitter.com/intent/tweet?url={{ urlencode(url(route('posts.show', $post->slug, false))) }}&text={{ urlencode($post->title) }}"
                            icon="x"
                            target="_blank"
                            rel="noopener noreferrer"
                    />
                    <x-link.icon
                            href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . url(route('posts.show', $post->slug, false))) }}"
                            icon="message-circle"
                            target="_blank"
                            rel="noopener noreferrer"
                    />
                    <x-link.icon
                            href="mailto:?subject={{ rawurlencode($post->title) }}&body={{ rawurlencode('Check out this article: ' . url(route('posts.show', $post->slug, false))) }}"
                            icon="mail"
                    />
                </div>

                <div>
                    <livewire:likes.likes type="post" id="{{ $post->id }}"/>
                </div>
            </div>
        </x-slot>
    </x-card.blog>
    <livewire:comments.comments-index :post=" $post"/>

    <x-slot name="side">
        <div class="flex flex-col gap-6">
            @if(isset($moreFromAuthor) && $moreFromAuthor->isNotEmpty())

                <x-card.side>
                    <x-slot name="header">
                        {{ __('More from') }} {{ ucfirst($post->author->username) }}
                    </x-slot>
                    <div class="flex flex-col gap-4">
                        @foreach($moreFromAuthor as $morePost)
                            <div class="flex gap-3 items-start">
                                <a href="{{ route('posts.show', $morePost->slug) }}"
                                   class="block shrink-0 w-24 h-16 rounded overflow-hidden">
                                    <img src="{{ asset('storage/' . $morePost->featured_image) }}"
                                         alt="{{ $morePost->title }}"
                                         class="w-24 h-16 object-cover">
                                </a>
                                <div class="flex-1">
                                    <a href="{{ route('posts.show', $morePost->slug) }}"
                                       class="text-sm font-medium text-primary hover:text-secondary line-clamp-2">{{ $morePost->title }}</a>
                                    <div class="text-xs text-primary/70 mt-1">{{ $morePost->getFormattedDate() }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pt-3 flex justify-end">
                        <x-link.default
                                href="{{ route('posts.index', ['author' => $post->author->username]) }}">
                            {{ __('View all by') }} {{ ucfirst($post->author->username) }}
                        </x-link.default>
                    </div>
                </x-card.side>
            @endif

            @if(isset($moreInCategory) && $moreInCategory->isNotEmpty())
                <x-card.side>
                    <x-slot name="header">
                        {{ __('More in Category') }}
                    </x-slot>
                    <div class="flex flex-col gap-4">
                        @foreach($moreInCategory as $catPost)
                            <div class="flex gap-3 items-start">
                                <a href="{{ route('posts.show', $catPost->slug) }}"
                                   class="block shrink-0 w-24 h-16 rounded overflow-hidden">
                                    <img src="{{ asset('storage/' . $catPost->featured_image) }}"
                                         alt="{{ $catPost->title }}"
                                         class="w-24 h-16 object-cover">
                                </a>
                                <div class="flex-1">
                                    <a href="{{ route('posts.show', $catPost->slug) }}"
                                       class="text-sm font-medium text-primary hover:text-secondary line-clamp-2">{{ $catPost->title }}</a>
                                    <div class="text-xs text-primary/70 mt-1">{{ $catPost->getFormattedDate() }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pt-3 flex justify-end">
                        <x-link.default
                                href="{{ route('posts.index', ['category' => $post->category->slug]) }}">
                            {{ __('View all in') }} {{ $post->category->name }}
                        </x-link.default>
                    </div>
                </x-card.side>
            @endif
        </div>
    </x-slot>
</x-app-layout>