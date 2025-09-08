<div>
    @if($currentGame)
        <div class="mb-6">
            <x-heading.sub>Huidige spel</x-heading.sub>
            <x-card.default>
                <p class="text-sm text-secondary font-black">Gestart: {{ $currentGame->getFormattedDate() }}</p>

                <div class="mt-4">
                    <h5 class="font-medium text-primary">Nog aanwezige spelers:</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                        @foreach($currentGame->gamePlayers as $gamePlayer)
                            @if(!in_array($gamePlayer->user_id, $eliminatedPlayers))
                                <div class="p-3 border rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <span class="text-primary">{{ ucfirst($gamePlayer->user->username) }}</span>
                                        <button
                                                wire:click="eliminatePlayer({{ $gamePlayer->user_id }})"
                                                class="px-3 py-1 bg-error text-primary rounded hover:bg-error/50 flex items-center gap-2"
                                        >
                                            <x-lucide-paintbrush class="w-4 h-4"/>
                                            uit het spel
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                @if(count($eliminatedPlayers) > 0)
                    <div class="mt-4">
                        <h5 class="font-medium text-primary">Spelers uit het spel:</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                            @foreach($currentGame->gamePlayers()->whereIn('user_id', $eliminatedPlayers)->orderBy('position')->get() as $gamePlayer)
                                <div class="p-3 border rounded-lg {{ $gamePlayer->position == 1 ? 'bg-danger' : '' }}">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="font-medium text-primary">{{ ucfirst($gamePlayer->user->username) }}</span>
                                            <span class="text-sm text-primary block">
                                            Positie: {{ $gamePlayer->position }} | Punten: {{ $gamePlayer->points }}
                                        </span>
                                        </div>

                                        @if($gamePlayer->position == 1 && !$gamePlayer->cup_photo_path && $this->isFirstGameOfDay($currentGame))
                                            <div class="flex gap-2">
                                                <input type="file" wire:model="cupPhoto" class="hidden" accept="image/*" capture="environment"
                                                       id="cup-photo-{{ $gamePlayer->id }}">
                                                <label for="cup-photo-{{ $gamePlayer->id }}"
                                                       class="cursor-pointer px-3 py-1 border border-border-secondary text-white text-center rounded hover:bg-danger-hover">
                                                    Upload foto
                                                </label>
                                                <x-form.error for="cupPhoto" class="mt-2"/>

                                                @if($cupPhoto)
                                                    <x-button.secondary
                                                            wire:click="uploadCupPhoto({{ $gamePlayer->user_id }})">
                                                        Save
                                                    </x-button.secondary>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </x-card.default>
        </div>
    @else
        @if($showGameForm)
            <div class="mb-6">
                <x-heading.sub>Nieuwe wedstijd</x-heading.sub>
                <x-card.default>
                    <form wire:submit.prevent="startNewGame">
                        <div class="my-4">
                            <x-form.label for="gameDate" value="{{ __('Datum') }}" class="pb-2"/>
                            <x-form.input type="datetime-local" wire:model="gameDate" class="w-full"/>
                            <x-form.error for="gameDate" class="mt-2"/>
                        </div>

                        <div class="mb-4">
                            <x-form.label for="selectedPlayers" value="{{ __('Selecteer spelers') }}"/>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                                @foreach($availablePlayers as $player)
                                    <label class="flex items-center text-primary space-x-2 p-2 border border-secondary/30 rounded-lg cursor-pointer hover:bg-background-hover hover:text-secondary hover:border-secondary">
                                        <x-form.checkbox wire:model="selectedPlayers" value="{{ $player->id }}"/>
                                        <span>{{ ucfirst($player->username) }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-form.error for="selectedPlayers" class="mt-2"/>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <x-button.secondary type="button" wire:click="$set('showGameForm', false)">
                                Cancel
                            </x-button.secondary>
                            <x-button.default type="submit">
                                Nieuwe wedstijd starten
                            </x-button.default>
                        </div>
                    </form>
                </x-card.default>
            </div>
        @else
            @can('create:game')
                <div class="flex justify-end space-x-2">
                    <x-button.default
                            wire:click="$set('showGameForm', true)">
                        Nieuwe wedstijd starten
                    </x-button.default>
                </div>
            @endcan
        @endif
    @endif

    <x-heading.sub>Recente wedstijden</x-heading.sub>
    <x-card.default>
        @if($recentGames->isEmpty())
            <p class="text-primary-muted">Geen wedstijden tot nu toe</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-secondary/30">
                    <thead class="bg-background">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            Datum
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            Spelers
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            Winnaar beker
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            Winnaar
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary/30">
                    @foreach($recentGames as $game)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                                {{ $game->getFormattedDate() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                                {{ $game->gamePlayers->count() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                                @php
                                    $cupWinner = $game->gamePlayers()->where('position', 1)->first()?->user;
                                @endphp
                                {{ $cupWinner ? $cupWinner->name : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                                @php
                                    $winner = $game->gamePlayers()->where('is_winner', true)->first()?->user;
                                @endphp
                                {{ $winner ? $winner->name : 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-card.default>
</div>