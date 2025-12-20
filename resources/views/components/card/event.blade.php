<article class="bg-background">
    <div class="flex items-stretch gap-2">
        @if (isset($image))
            <header class="hidden relative md:block md:w-1/3">
                {{ $image }}
            </header>
        @endif

        <main class="flex flex-col flex-1">
            <div class="px-2 md:px-0 pt-4">
                {{ $slot }}
            </div>

            @if (isset($footer))
                <footer class="hidden md:block px-2 mt-auto">
                    {{ $footer }}
                </footer>
            @endif
        </main>
    </div>
</article>


