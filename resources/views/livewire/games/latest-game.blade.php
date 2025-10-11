<div>
    <x-card.side>
        <x-slot name="header">
            {{ __('Latest Game')}}
        </x-slot>

        <div class="p-4">
            @if($latestGame)
                {{--                TODO: ADD GAME DETAILS--}}
            @else
                <div class="text-primary-muted flex flex-col items-center gap-2">
                    <x-lucide-dices class="w-14 h-14 text-secondary"/>
                    <p class="text-xl">
                        {{ __('No games yet') }}</p>
                </div>
            @endif
        </div>
    </x-card.side>
</div>

