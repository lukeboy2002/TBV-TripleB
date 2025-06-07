<div class="rounded-lg bg-background-accent shadow-xs ring-1 ring-ring/30 p-2">
    <x-tbv-heading_h5>Cup Holder</x-tbv-heading_h5>
    @if(isset($winner) && $winner->cup_photo_path !== null)
        <div class="w-full">
            <img class="rounded-lg w-full max-h-52 object-cover"
                 src="{{ asset($winner->cup_photo_path) }}"
                 alt="latest winner"/>
        </div>
    @else
        <p class="text-center py-2 text-secondary">There cup holder</p>
    @endif
</div>
