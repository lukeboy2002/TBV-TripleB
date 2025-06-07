<!-- resources/views/livewire/game-manager.blade.php -->
<div class="p-4 rounded-lg shadow">
    <x-tbv-heading_h5>Games</x-tbv-heading_h5>

    @if($currentGame)
        <div class="mb-6">
            <h4 class="text-lg font-semibold">Current Game in Progress</h4>
            <p class="text-sm text-secondary">Started: {{ $currentGame->date->format('M d, Y H:i') }}</p>

            <div class="mt-4">
                <h5 class="font-medium">Remaining Players:</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                    @foreach($currentGame->gamePlayers as $gamePlayer)
                        @if(!in_array($gamePlayer->user_id, $eliminatedPlayers))
                            <div class="p-3 border rounded-lg">
                                <div class="flex items-center justify-between">
                                    <span>{{ ucfirst($gamePlayer->user->username) }}</span>
                                    <button
                                            wire:click="eliminatePlayer({{ $gamePlayer->user_id }})"
                                            class="px-3 py-1 bg-danger text-white rounded hover:bg-danger/50"
                                    >
                                        Eliminate
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            @if(count($eliminatedPlayers) > 0)
                <div class="mt-4">
                    <h5 class="font-medium">Eliminated Players:</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                        @foreach($currentGame->gamePlayers()->whereIn('user_id', $eliminatedPlayers)->orderBy('position')->get() as $gamePlayer)
                            <div class="p-3 border rounded-lg {{ $gamePlayer->position == 1 ? 'bg-danger' : '' }}">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="font-medium text-primary">{{ ucfirst($gamePlayer->user->username) }}</span>
                                        <span class="text-sm text-primary block">
                                            Position: {{ $gamePlayer->position }} | Points: {{ $gamePlayer->points }}
                                        </span>
                                    </div>

                                    @if($gamePlayer->position == 1 && !$gamePlayer->cup_photo_path && $this->isFirstGameOfDay($currentGame))
                                        <div class="flex gap-2">
                                            <input type="file" wire:model="cupPhoto" class="hidden"
                                                   id="cup-photo-{{ $gamePlayer->id }}">
                                            <label for="cup-photo-{{ $gamePlayer->id }}"
                                                   class="cursor-pointer px-3 py-1 border border-border-secondary text-white text-center rounded hover:bg-danger-hover">
                                                Upload Cup Photo
                                            </label>
                                            <x-tbv-input-error for="cupPhoto" class="mt-2"/>

                                            @if($cupPhoto)
                                                <x-tbv-button_secondary
                                                        wire:click="uploadCupPhoto({{ $gamePlayer->user_id }})">
                                                    Save Photo
                                                </x-tbv-button_secondary>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="mb-6">
            @if($showGameForm)
                <form wire:submit.prevent="startNewGame">
                    <div class="my-4">
                        <x-tbv-label for="gameDate" value="{{ __('Game date') }}" class="pb-2"/>
                        <x-tbv-input type="datetime-local" wire:model="gameDate" class="w-full"/>
                        <x-tbv-input-error for="gameDate" class="mt-2"/>
                    </div>

                    <div class="mb-4">
                        <x-tbv-label for="selectedPlayers" value="{{ __('Select Players') }}"/>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                            @foreach($availablePlayers as $player)
                                <label class="flex items-center space-x-2 p-2 border rounded-lg cursor-pointer hover:bg-input hover:text-secondary">
                                    <input type="checkbox" wire:model="selectedPlayers" value="{{ $player->id }}"
                                           class="rounded text-secondary ring-ring">
                                    <span>{{ ucfirst($player->username) }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-tbv-input-error for="selectedPlayers" class="mt-2"/>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <x-tbv-button_secondary type="button" wire:click="$set('showGameForm', false)">
                            Cancel
                        </x-tbv-button_secondary>
                        <x-tbv-button type="submit">
                            Start Game
                        </x-tbv-button>
                    </div>
                </form>
            @else
                <div class="pt-4">
                    <x-tbv-button
                            wire:click="$set('showGameForm', true)">
                        Start New Game
                    </x-tbv-button>
                </div>
            @endif
        </div>
    @endif

    <div>
        <h4 class="text-xl font-semibold mb-2 text-secondary">Recent Games</h4>
        @if($recentGames->isEmpty())
            <p class="text-primary-muted">No completed games yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-divide/30">
                    <thead class="bg-background">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            Players
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            Cup
                            Winner
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            Winner
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-divide/30">
                    @foreach($recentGames as $game)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                                {{ $game->date->format('M d, Y H:i') }}
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
    </div>
</div>