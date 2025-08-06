<div class="mt-6">
    <x-heading.sub>Player Statistics</x-heading.sub>
    <x-card.default>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-secondary/30">
                <thead class="text-primary">
                <tr>
                    @include('livewire.sortable-th',[
                           'name' => 'username',
                            'displayName' => 'Player'
                       ])
                    @include('livewire.sortable-th',[
                           'name' => 'played',
                            'displayName' => 'Games Played'
                       ])
                    @include('livewire.sortable-th',[
                           'name' => 'points',
                            'displayName' => 'Points'
                       ])
                    @include('livewire.sortable-th',[
                           'name' => 'won',
                            'displayName' => 'Games Won'
                       ])
                    @include('livewire.sortable-th',[
                           'name' => 'cup',
                            'displayName' => 'Won Cup'
                       ])
                </tr>
                </thead>
                <tbody class="divide-y divide-secondary/30">
                @foreach($players as $player)
                    <tr class="text-primary">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($player->profile && $player->profile->image_path)
                                    <img class="h-10 w-10 rounded-full object-cover mr-3"
                                         src="{{ Storage::url($player->profile->image_path) }}"
                                         alt="{{ $player->name }}">
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-primary">{{ ucfirst($player->username) }}</div>
                                    <div class="text-sm text-primary-muted">{{ $player->name }}</div>

                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $player->total_games_played }}</td>
                        <td class="px-6 py-4">{{ $player->total_points }}</td>
                        <td class="px-6 py-4">{{ $player->total_games_won }}</td>
                        <td class="px-6 py-4">{{ $player->total_cups_won }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-card.default>
</div>