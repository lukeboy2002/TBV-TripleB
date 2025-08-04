<div>
    @if (isset($header))
        <div class="px-2 rounded-t-lg bg-background">
            <x-heading.side>{{ $header }}</x-heading.side>
        </div>
    @endif
    <main class="bg-background-hover rounded-b-lg">
        {{ $slot }}
    </main>
</div>

