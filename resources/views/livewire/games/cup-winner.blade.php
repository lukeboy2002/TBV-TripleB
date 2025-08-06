<x-card.side>
    <x-slot name="header">
        <div class="flex items-center gap-1">
            <span class="block xs:hidden md:hidden lg:block">Latest</span> Cup Winner
        </div>
    </x-slot>
    @if($winner)
        <div class="p-2">
            <div class="">
                <div class="flex justify-center items-center w-full">
                    <img src="{{ Storage::url($winner->cup_photo_path) }}"
                         alt="Cup Winner"
                         class="object-cover rounded-lg">
                </div>
            </div>
        </div>
    @else
        <div class="text-primary-muted p-2">No cup winner available yet.</div>
    @endif
</x-card.side>