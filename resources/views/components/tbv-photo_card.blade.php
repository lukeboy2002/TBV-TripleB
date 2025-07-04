<article class="bg-background/50 shadow-sm rounded-lg flex flex-col h-full">
    <main>
        {{ $slot }}
    </main>
    @if (isset($footer))
        <footer class="py-4 px-2 mt-auto">
            {{ $footer }}
        </footer>
    @endif
</article>