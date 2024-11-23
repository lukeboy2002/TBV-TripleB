<article class="bg-light rounded-lg border border-primary shadow-md dark:bg-dark">
    <div class="block md:flex">
        <div class="w-full md:w-1/3">
            <img src={{ $post->getImage() }}
             alt="{{ $post->title}}"
                 class="h-56 md:h-full w-full rounded-tl-lg object-cover"
            />
        </div>

        <div class="w-full md:w-2/3 pt-3 pb-6 px-6">
            <header>
                <div class="flex justify-between items-center space-y-2 text-xs pb-4">
                    <x-badge-category
                            wire:navigate
                            href="{{ route('posts.index', ['category' => $post->category->slug]) }}"
                            :Color="$post->category->color">
                        {{ $post->category->name }}
                    </x-badge-category>

                    <div class="text-dark dark:text-light">{{ $post->likes_count }} Likes</div>
                </div>
                <x-link-primary class="text-xl font-heading tracking-wide font-bold uppercase"
                                href="{{ route('posts.show', $post->slug) }}">
                    {{ $post->title }}
                </x-link-primary>
            </header>
            <main>
                <div class="my-4 flex justify-between items-center uppercase text-xs text-dark dark:text-light">
                    <div class="flex space-x-4 ">
                        <div>BY <span class="text-primary font-semibold">{{ $post->author->username }}</span></div>
                        <div>{{ $post->getFormattedDate() }}</div>
                    </div>
                    <div>
                        {{  $post->comments_count }} Comments
                    </div>
                </div>
                <div class="prose prose-sm max-w-none text-dark dark:text-light">
                    {{ $post->shortBody() }}
                </div>
            </main>
            <footer class="flex justify-end pt-4">
                <a href="{{ route('posts.show', $post->slug) }}"
                   class="inline-flex items-center text-primary hover:text-dark dark:hover:text-light focus:outline-none focus:text-dark/80 dark:focus:text-licht/80 transition duration-150 ease-in-out">
                    Read More
                    <x-heroicon-o-arrow-right-circle class="ml-1 size-4"/>
                </a>
            </footer>
        </div>
    </div>

</article>