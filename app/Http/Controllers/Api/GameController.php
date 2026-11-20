<?php

namespace App\Http\Controllers\Api;

use App\Actions\Games\EliminatePlayer;
use App\Actions\Games\SortPresentPlayers;
use App\Actions\Games\StartNewGame;
use App\Actions\Games\UploadCupPhoto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CupPhotoRequest;
use App\Http\Requests\Api\EliminatePlayerRequest;
use App\Http\Requests\Api\StartGameRequest;
use App\Http\Resources\GamePlayerResource;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Models\GamePlayer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * Gespeelde wedstrijden, nieuwste eerst, 10 per pagina (?page=2).
     */
    public function index(): AnonymousResourceCollection
    {
        $games = Game::where('status', 'completed')
            ->with('gamePlayers.user.profile')
            ->orderByDesc('date')
            ->orderByDesc('completed_at')
            ->paginate(10);

        return GameResource::collection($games);
    }

    public function show(Game $game): GameResource
    {
        return new GameResource($game->load('gamePlayers.user.profile'));
    }

    /**
     * De lopende wedstrijd (of null), met wie er nog in zit (in speelvolgorde) en wie al af is.
     */
    public function current(SortPresentPlayers $sortPresentPlayers): JsonResponse
    {
        $game = Game::where('status', 'in_progress')->latest()->first();

        return response()->json(['data' => $game ? $this->liveState($game, $sortPresentPlayers) : null]);
    }

    /**
     * Nieuwe wedstrijd starten. Er kan maar één wedstrijd tegelijk lopen.
     */
    public function store(StartGameRequest $request, StartNewGame $startNewGame, SortPresentPlayers $sortPresentPlayers): JsonResponse
    {
        if (Game::where('status', 'in_progress')->exists()) {
            return response()->json(['message' => __('A game is already in progress.')], 409);
        }

        [, $game] = $startNewGame(
            $request->input('date') ?? now()->format('Y-m-d H:i'),
            array_map('intval', $request->input('players'))
        );

        return response()->json(['data' => $this->liveState($game, $sortPresentPlayers)], 201);
    }

    /**
     * Een speler valt af. De laatste die overblijft wint automatisch (zie EliminatePlayer).
     */
    public function eliminate(EliminatePlayerRequest $request, Game $game, EliminatePlayer $eliminatePlayer, SortPresentPlayers $sortPresentPlayers): JsonResponse
    {
        $userId = (int) $request->input('user_id');

        // In een transactie met een lock: als twee telefoons tegelijk tikken, wacht de tweede op de eerste.
        $result = DB::transaction(function () use ($game, $userId, $eliminatePlayer) {
            $game = Game::whereKey($game->id)->lockForUpdate()->firstOrFail();

            if ($game->status !== 'in_progress') {
                return ['error' => __('This game is already finished.')];
            }

            $gamePlayer = $game->gamePlayers()->where('user_id', $userId)->first();

            if (! $gamePlayer || $gamePlayer->position !== null) {
                return ['error' => __('This player is not (or no longer) in the game.')];
            }

            $eliminated = $this->eliminatedIds($game);
            [, , $completed] = $eliminatePlayer($game, $eliminated, $userId);

            return ['completed' => $completed];
        });

        if (isset($result['error'])) {
            return response()->json(['message' => $result['error']], 422);
        }

        $game->refresh();

        if ($result['completed']) {
            return response()->json([
                'completed' => true,
                'data' => new GameResource($game->load('gamePlayers.user.profile')),
            ]);
        }

        return response()->json([
            'completed' => false,
            'data' => $this->liveState($game, $sortPresentPlayers),
        ]);
    }

    /**
     * Foto van de bekerwinnaar (wie als eerste afviel) uploaden, na afloop van de wedstrijd.
     */
    public function cupPhoto(CupPhotoRequest $request, Game $game, UploadCupPhoto $uploadCupPhoto): JsonResponse
    {
        $cupPlayer = $game->gamePlayers()->where('position', 1)->first();

        if ($game->status !== 'completed' || ! $cupPlayer) {
            return response()->json(['message' => __('This game has no cup winner yet.')], 422);
        }

        if (! $uploadCupPhoto($request->file('photo'), $cupPlayer->user_id, $game->id)) {
            return response()->json(['message' => __('Photo upload failed. Please try again.')], 500);
        }

        return response()->json([
            'data' => new GamePlayerResource($cupPlayer->fresh()->load('user.profile')),
        ]);
    }

    /**
     * De laatste bekerwinnaar met foto, zoals op de homepage van de site.
     */
    public function cupWinner(): JsonResponse
    {
        $winner = GamePlayer::whereNotNull('cup_photo_path')
            ->with(['user.profile', 'game'])
            ->latest()
            ->first();

        return response()->json([
            'data' => $winner ? [
                ...(new GamePlayerResource($winner))->resolve(),
                'game_id' => $winner->game_id,
                'game_date' => $winner->game?->date?->toIso8601String(),
            ] : null,
        ]);
    }

    /**
     * @return array<int, int>
     */
    private function eliminatedIds(Game $game): array
    {
        return $game->gamePlayers()
            ->whereNotNull('position')
            ->orderBy('position')
            ->pluck('user_id')
            ->map(fn ($id) => (int) $id)
            ->all();
    }

    /**
     * @return array<string, mixed>
     */
    private function liveState(Game $game, SortPresentPlayers $sortPresentPlayers): array
    {
        $game->load('gamePlayers.user.profile');
        $eliminated = $this->eliminatedIds($game);

        return [
            'id' => $game->id,
            'date' => $game->date?->toIso8601String(),
            'status' => $game->status,
            'remaining' => GamePlayerResource::collection($sortPresentPlayers($game, $eliminated))->resolve(),
            'eliminated' => GamePlayerResource::collection(
                $game->gamePlayers->whereNotNull('position')->sortBy('position')->values()
            )->resolve(),
        ];
    }
}
