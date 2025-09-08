<x-card.side>
    <x-slot name="header">
        <div class="flex items-center gap-1">
            Beker winnaar
        </div>
    </x-slot>
    @if($winner)
        <div class="p-4">
            <div class="">
                <div class="flex justify-center items-center w-full">
                    <img src="{{ asset('storage/'. $winner->cup_photo_path) }}"
                         alt="Cup Winner"
                         class="object-cover rounded-lg">
                </div>
            </div>
        </div>
    @else
        <div class="text-primary-muted p-2">Geen beker winnaar</div>
    @endif
</x-card.side>