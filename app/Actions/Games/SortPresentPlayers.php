<?php

namespace App\Actions\Games;

use App\Models\Game;
use App\Models\GamePlayer;
use Illuminate\Support\Collection;

/**
 * Bepaalt in welke volgorde de spelers die nog in het spel zitten getoond worden.
 *
 * - Eerste spel van de dag (of geen vorig spel): alfabetisch op gebruikersnaam.
 * - Anders: eerst wie in het vorige spel meedeed, op punten van dat spel (hoog naar laag),
 *   daarna de rest alfabetisch.
 *
 * Wordt gebruikt door de Livewire-pagina en door de API, zodat de volgorde overal gelijk is.
 */
class SortPresentPlayers
{
    public function __construct(private IsFirstGameOfDay $isFirstGameOfDay) {}

    /**
     * @param  array<int,int>  $eliminatedPlayers
     * @return Collection<int, GamePlayer>
     */
    public function __invoke(Game $game, array $eliminatedPlayers): Collection
    {
        $activeGamePlayers = $game->gamePlayers
            ->filter(fn ($gp) => ! in_array($gp->user_id, $eliminatedPlayers))
            ->values();

        if ($activeGamePlayers->isEmpty()) {
            return collect();
        }

        $alphabetical = fn (Collection $players) => $players->sortBy(
            fn ($gp) => strtolower($gp->user?->username ?? ''),
            SORT_NATURAL | SORT_FLAG_CASE
        )->values();

        if (($this->isFirstGameOfDay)($game)) {
            return $alphabetical($activeGamePlayers);
        }

        $gameDate = $game->date ? $game->date->toDateString() : now()->toDateString();

        $previousGameQuery = fn () => Game::where('status', 'completed')
            ->where('id', '!=', $game->id)
            ->whereNotNull('completed_at')
            ->where('completed_at', '<', $game->completed_at ?? now())
            ->orderByDesc('completed_at')
            ->with('gamePlayers');

        $previousGame = $previousGameQuery()->whereDate('date', $gameDate)->first()
            ?? $previousGameQuery()->first();

        if (! $previousGame) {
            return $alphabetical($activeGamePlayers);
        }

        $previousScores = $previousGame->gamePlayers->pluck('points', 'user_id');

        $playedPrevious = $activeGamePlayers->filter(fn ($gp) => $previousScores->has($gp->user_id));
        $notPlayedPrevious = $activeGamePlayers->filter(fn ($gp) => ! $previousScores->has($gp->user_id));

        $sortedPlayed = $playedPrevious->sort(function ($a, $b) use ($previousScores) {
            $scoreA = $previousScores->get($a->user_id, 0);
            $scoreB = $previousScores->get($b->user_id, 0);
            if ($scoreA !== $scoreB) {
                return $scoreB <=> $scoreA;
            }

            return strcasecmp($a->user?->username ?? '', $b->user?->username ?? '');
        })->values();

        return $sortedPlayed->concat($alphabetical($notPlayedPrevious))->values();
    }
}
