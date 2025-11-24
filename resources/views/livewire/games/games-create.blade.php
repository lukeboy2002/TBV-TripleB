<div>
    @if($currentGame)
        <div class="mb-6">
            <x-card.default>
                <p class="text-sm text-secondary font-black">{{ __('Started:') }} {{ $currentGame->getFormattedDate() }}</p>

                <div class="mt-4">
                    <h5 class="font-medium text-primary">{{ __('Players present:') }}</h5>
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
                                            {{ __('Lost') }}
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                @if(count($eliminatedPlayers) > 0)
                    <div class="mt-4">
                        <h5 class="font-medium text-primary">{{ __('Players from the game:') }}</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                            @foreach($currentGame->gamePlayers()->whereIn('user_id', $eliminatedPlayers)->orderBy('position')->get() as $gamePlayer)
                                <div class="p-3 border rounded-lg {{ $gamePlayer->position == 1 ? 'bg-danger' : '' }}">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="font-medium text-primary">{{ ucfirst($gamePlayer->user->username) }}</span>
                                            <span class="text-sm text-primary block">
                                            {{ __('Position:') }}: {{ $gamePlayer->position }} | {{ __('Points') }}: {{ $gamePlayer->points }}
                                        </span>
                                        </div>

                                        @if($gamePlayer->position == 1 && !$gamePlayer->cup_photo_path && $this->isFirstGameOfDay($currentGame))
                                            <div class="flex gap-2">
                                                <input type="file" wire:model="cupPhoto" class="hidden" accept="image/*"
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
                <x-card.default>
                    <form wire:submit.prevent="startNewGame">
                        <div class="my-4">
                            <x-form.label for="gameDate" value="{{ __('Date') }}" class="pb-2"/>
                            <x-form.input type="datetime-local" wire:model="gameDate" class="w-full"/>
                            <x-form.error for="gameDate" class="mt-2"/>
                        </div>

                        <div class="mb-4">
                            <x-form.label for="selectedPlayers" value="{{ __('Select players') }}"/>
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
                            <x-link.buttonSecondary href="{{ route('games') }}">
                                {{ __('Cancel') }}
                            </x-link.buttonSecondary>
                            <x-button.default type="submit">
                                {{ __('Start New Game') }}
                            </x-button.default>
                        </div>
                    </form>
                </x-card.default>
            </div>
        @endif
    @endif
</div>