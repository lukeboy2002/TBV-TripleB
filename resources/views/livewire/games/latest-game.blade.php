<div>
    <x-card.side>
        <x-slot name="header">
            {{ __('Latest Game')}}
        </x-slot>

        <div class="py-4 px-2">
            @if($latestGame)
                <div class="divide-y divide-secondary/30">
                    @foreach($latestGame->gamePlayers as $player)
                        <div class="flex items-center justify-between py-2">
                            <div class="flex items-center gap-3">
                                <div class="font-medium text-primary">
                                    {{ ucfirst($player->user->username ?? ($player->user->name ?? 'Unknown')) }}
                                </div>
                                @if($player->is_winner)
                                    <span class="text-xs bg-success/20 text-success px-2 py-0.5 rounded">{{ __('Winner') }}</span>
                                @endif
                            </div>
                            <div class="text-sm text-primary-muted">
                                @if(!is_null($player->points))
                                    <span class="ml-2"> {{ __('Points') }} {{ $player->points }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
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

