<div class="mt-6">
    <x-heading.sub>Standen</x-heading.sub>
    <x-card.default>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-secondary/30">
                <thead class="text-primary">
                <tr>
                    @include('livewire.sortable-th',[
                           'name' => 'username',
                            'displayName' => 'Username'
                       ])
                    @include('livewire.sortable-th',[
                           'name' => 'played',
                            'displayName' => 'Gespeeld'
                       ])
                    @include('livewire.sortable-th',[
                           'name' => 'points',
                            'displayName' => 'Punten'
                       ])
                    @include('livewire.sortable-th',[
                           'name' => 'won',
                            'displayName' => 'Gewonnen'
                       ])
                    @include('livewire.sortable-th',[
                           'name' => 'cup',
                            'displayName' => 'Bekers'
                       ])
                    {{--                    @include('livewire.sortable-th',[--}}
                    {{--                           'name' => 'avg',--}}
                    {{--                            'displayName' => 'Avg'--}}
                    {{--                       ])--}}
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
                        <td class="px-6 py-4 text-center">{{ $player->total_games_played }}</td>
                        <td class="px-6 py-4 text-center">{{ $player->total_points }}</td>
                        <td class="px-6 py-4 text-center">{{ $player->total_games_won }}</td>
                        <td class="px-6 py-4 text-center">{{ $player->total_cups_won }}</td>
                        {{--                        <td class="px-6 py-4">{{ number_format($player->average_points ?? 0, 2) }}</td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-card.default>
</div>