<x-card.side>
    <x-slot name="header">
        <div class="flex items-center gap-1">
            Laatste wedstijd
        </div>
    </x-slot>
    @if(!$latestGame)
        <div class="text-primary-muted p-2">Geen wedstijden.</div>
    @else
        <div class="p-4">
            <div class="text-sm text-secondary font-black mb-3">
                Gespeeld: {{ optional($latestGame->date)->format('M d, Y H:i') }}
            </div>

            <div class="divide-y divide-secondary/30">
                @foreach($latestGame->gamePlayers as $player)
                    <div class="flex items-center justify-between py-2">
                        <div class="flex items-center gap-3">
                            <div class="font-medium text-primary">
                                {{ ucfirst($player->user->username ?? ($player->user->name ?? 'Unknown')) }}
                            </div>
                            @if($player->is_winner)
                                <span class="text-xs bg-success/20 text-success px-2 py-0.5 rounded">Winnaar</span>
                            @endif
                        </div>
                        <div class="text-sm text-primary-muted">
                            @if(!is_null($player->points))
                                <span class="ml-2">• Punten: {{ $player->points }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-card.side>