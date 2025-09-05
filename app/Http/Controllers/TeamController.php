<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\TeamPlayer;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function add($id)
   {
    // Limit a max 5 players to a team
    if (TeamPlayer::count() >= 5) {
        return redirect()->route('players.index')->with('success', 'Team is full. Max 5 players allowed.');
    }

    // Prevent duplicate players from joining
    if (!TeamPlayer::where('player_id', $id)->exists()) {
        TeamPlayer::create(['player_id' => $id]);
    }

    return redirect()->route('players.index', ['sort' => request('sort')])
    ->with('success', 'Player added to team.');

}

    public function index()
    {
    $teamPlayers = TeamPlayer::with('player')->get();

    
    $totals = [
        'PTS' => 0, 'AST' => 0, 'TRB' => 0,
    ];

    foreach ($teamPlayers as $tp) {
        $totals['PTS'] += $tp->player->PTS ?? 0;
        $totals['AST'] += $tp->player->AST ?? 0;
        $totals['TRB'] += $tp->player->TRB ?? 0;
    }

    //FORMULA FOR PREDICTING SEASON
   $baseScore = $totals['PTS'] * 0.6 + $totals['AST'] * 0.3 + $totals['TRB'] * 0.1;

    //RANDOMNESS FACTOR
    $randomFactor = rand(85, 105) / 100;
    $score = $baseScore * $randomFactor;

    $wins = min(82, max(0, round($score)));


    //RESULTS BASED OFF PREDICTION
    $playoffResult = match (true) {
        $wins >= 60 => 'NBA Finals',
        $wins >= 50 => 'Conference Finals',
        $wins >= 40 => 'Playoffs',
        default     => 'Missed Playoffs',
    };

    return view('team.index', compact('teamPlayers', 'wins', 'playoffResult'));
    }



    public function remove($id)
    {
    TeamPlayer::where('player_id', $id)->delete();
    return redirect()->route('team.index')->with('success', 'Player removed from team.');
    }
}
