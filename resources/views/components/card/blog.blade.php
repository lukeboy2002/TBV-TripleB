<article class="bg-background flex flex-col h-full">
    @if (isset($header))
        <header class="relative">
            {{ $header }}
        </header>
    @endif
    <main class="py-4 px-2 flex-1">
        {{ $slot }}
    </main>
    @if (isset($footer))
        <footer class="py-4 px-2 mt-auto">
            {{ $footer }}
        </footer>
    @endif
</article>