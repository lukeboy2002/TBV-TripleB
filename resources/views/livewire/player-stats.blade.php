<!-- resources/views/livewire/player-stats.blade.php -->
<div class="p-4 rounded-lg shadow">
    <x-tbv-heading_h5>Player Statistics</x-tbv-heading_h5>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-divide/30">
            <thead class="bg-background">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                    Player
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider cursor-pointer"
                    wire:click="sortBy('total_games_played')">
                    Games Played
                    @if($sortField === 'total_games_played')
                        <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                    @endif
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider cursor-pointer"
                    wire:click="sortBy('total_points')">
                    Points
                    @if($sortField === 'total_points')
                        <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                    @endif
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider cursor-pointer"
                    wire:click="sortBy('total_games_won')">
                    Games Won
                    @if($sortField === 'total_games_won')
                        <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                    @endif
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider cursor-pointer"
                    wire:click="sortBy('total_cups_won')">
                    Cups Won
                    @if($sortField === 'total_cups_won')
                        <span>{!! $sortDirection === 'asc' ? '&uarr;' : '&darr;' !!}</span>
                    @endif
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-divide/30">
            @foreach($players as $player)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($player->profile && $player->profile->image_path)
                                <img class="h-10 w-10 rounded-full object-cover mr-3"
                                     src="{{ Storage::url($player->profile->image_path) }}" alt="{{ $player->name }}">
                            @endif
                            <div>
                                <div class="text-sm font-medium text-primary">{{ $player->name }}</div>
                                <div class="text-sm text-secondary">{{ ucfirst($player->username) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                        {{ $player->total_games_played }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                        {{ $player->total_points }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                        {{ $player->total_games_won }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                        {{ $player->total_cups_won }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $players->links(data: ['scrollTo' => false]) }}
    </div>
</div>