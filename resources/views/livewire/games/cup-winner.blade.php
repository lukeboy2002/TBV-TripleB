<div>
    <x-card.side>
        <x-slot name="header">
            {{ __('Cup Holder')}}
        </x-slot>

        <div class="p-4">
            @if($winner)
                <div class="flex justify-center items-center w-full">
                    <img src="{{ asset('storage/'. $winner->cup_photo_path) }}"
                         alt="Cup Winner"
                         class="object-cover rounded-lg">
                </div>
            @else
                <div class="text-primary-muted flex flex-col items-center gap-2">
                    <x-lucide-trophy class="w-14 h-14 text-secondary"/>
                    <p class="text-xl">
                        {{ __('No cup winner yet') }}</p>
                </div>
            @endif
        </div>
    </x-card.side>
</div>

