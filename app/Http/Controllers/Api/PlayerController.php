<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlayerResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlayerController extends Controller
{
    /**
     * Zelfde kolommen als de sorteer-knoppen op de site (PlayerStats).
     *
     * @var array<string, string>
     */
    private const SORT_COLUMNS = [
        'username' => 'username',
        'played' => 'total_games_played',
        'points' => 'total_points',
        'avg' => 'average_points',
        'won' => 'total_games_won',
        'cup' => 'total_cups_won',
    ];

    /**
     * De stand: alle spelers met hun statistieken. ?sort=points&dir=desc
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $sort = self::SORT_COLUMNS[$request->query('sort')] ?? 'total_points';
        $dir = strtolower((string) $request->query('dir', 'desc')) === 'asc' ? 'asc' : 'desc';

        $players = User::role('member')
            ->notBanned()
            ->with('profile')
            ->withCount(['gamePlayers as total_games_played'])
            ->withSum('gamePlayers as total_points', 'points')
            ->withAvg('gamePlayers as average_points', 'points')
            ->withCount(['gamePlayers as total_games_won' => fn ($query) => $query->where('is_winner', true)])
            ->withCount(['gamePlayers as total_cups_won' => fn ($query) => $query->where('position', 1)])
            ->orderBy($sort, $dir)
            ->orderBy('username')
            ->get();

        return PlayerResource::collection($players);
    }
}
