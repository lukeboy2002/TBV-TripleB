<div {{ $attributes->merge(['class' =>"w-full"]) }}>
    @if (isset($header))
        <div class="px-2 rounded-t-lg bg-background">
            <x-heading.side>{{ $header }}</x-heading.side>
        </div>
    @endif
    @if (isset($footer))
        <main class="bg-background-hover py-4 px-4">
            {{ $slot }}
        </main>

        <div class="p-2 rounded-b-lg bg-background">
            {{ $footer }}
        </div>
    @else
        <main class="bg-background-hover rounded-b-lg py-4 px-4">
            {{ $slot }}
        </main>
    @endif
</div>

