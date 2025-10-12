{{--<div>--}}
{{--    <x-card.default>--}}
{{--        @if($recentGames->isEmpty())--}}
{{--            <div class="text-primary-muted flex flex-col items-center gap-2">--}}
{{--                <x-lucide-dices class="w-14 h-14 text-secondary"/>--}}
{{--                <p class="text-xl">--}}
{{--                    {{ __('No games yet') }}</p>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="overflow-x-auto">--}}
{{--                <table class="min-w-full divide-y divide-secondary/30">--}}
{{--                    <thead class="bg-background">--}}
{{--                    <tr>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">--}}
{{--                            {{ __('Date') }}--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">--}}
{{--                            {{ __('Players') }}--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">--}}
{{--                            {{ __('Cup Holder') }}--}}
{{--                        </th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">--}}
{{--                            {{ __('Winner') }}--}}
{{--                        </th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody class="divide-y divide-secondary/30">--}}
{{--                    @foreach($recentGames as $game)--}}
{{--                        <tr>--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">--}}
{{--                                {{ $game->getFormattedDate() }}--}}
{{--                            </td>--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">--}}
{{--                                {{ $game->gamePlayers->count() }}--}}
{{--                            </td>--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">--}}
{{--                                @php--}}
{{--                                    $cupWinner = $game->gamePlayers()->where('position', 1)->first()?->user;--}}
{{--                                @endphp--}}
{{--                                {{ $cupWinner ? $cupWinner->name : 'N/A' }}--}}
{{--                            </td>--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">--}}
{{--                                @php--}}
{{--                                    $winner = $game->gamePlayers()->where('is_winner', true)->first()?->user;--}}
{{--                                @endphp--}}
{{--                                {{ $winner ? $winner->name : 'N/A' }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </x-card.default>--}}
{{--    <div class="px-4 py-4">--}}
{{--        {{ $recentGames->links() }}--}}
{{--    </div>--}}
{{--</div>--}}
<div>
    <x-card.default>
        @if($recentGames->isEmpty())
            <div class="text-primary-muted flex flex-col items-center gap-2">
                <x-lucide-dices class="w-14 h-14 text-secondary"/>
                <p class="text-xl">
                    {{ __('No games yet') }}</p>
            </div>
        @else
            @php
                // Houd per dag bij of de naam al is getoond
                $shownDates = [];
            @endphp
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-secondary/30">
                    <thead class="bg-background">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            {{ __('Date') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            {{ __('Players') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            {{ __('Cup Holder') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary-muted uppercase tracking-wider">
                            {{ __('Winner') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary/30">
                    @foreach($recentGames as $game)
                        @php
                            // Normaliseer naar dag
                            $dateKey = $game->date->toDateString(); // Y-m-d

                            // Zoek de speler met positie 1 én foto binnen deze game
                            $cupPlayerWithPhoto = $game->gamePlayers()
                                ->where('position', 1)
                                ->whereNotNull('cup_photo_path')
                                ->first();

                            // We tonen alleen de naam als:
                            // - dit de eerste keer is voor deze dag
                            // - er daadwerkelijk een speler met foto is
                            $shouldShowCupName = !in_array($dateKey, $shownDates, true) && $cupPlayerWithPhoto?->user;
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                                {{ $game->getFormattedDate() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                                {{ $game->gamePlayers->count() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                                {{ $shouldShowCupName ? $cupPlayerWithPhoto->user->name : '' }}
                                @if($shouldShowCupName)
                                    @php $shownDates[] = $dateKey; @endphp
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-primary-muted">
                                @php
                                    $winner = $game->gamePlayers()->where('is_winner', true)->first()?->user;
                                @endphp
                                {{ $winner ? $winner->name : '' }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-card.default>
    <div class="px-4 py-4">
        {{ $recentGames->links() }}
    </div>
</div>