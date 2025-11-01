<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\TeamPlayer;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function add(Request $request, $id)
   {
    if (TeamPlayer::count() >= 5) {
        return redirect()->route('players.index')->with('success', 'Team is full. Max 5 players allowed.');
    }
    
    $playerId = (string) $id;
    if (!TeamPlayer::where('player_id', $playerId)->exists()) {
        TeamPlayer::create(['player_id' => $playerId]);
    }

    $redirectParams = ['sort' => $request->input('sort')];
    if ($request->has('search')) {
        $redirectParams['search'] = $request->input('search');
    }
    return redirect()->route('players.index', $redirectParams)
    ->with('success', 'Player added to team.');

}

    public function index()
    {
    $teamPlayers = TeamPlayer::with('player')->get();

    if ($teamPlayers->isEmpty() || $teamPlayers->count() < 3) {
        $wins = 0;
        $playoffResult = ['Need at least 3 players', 'Add more players to see predictions'];
        $totals = ['PTS' => 0, 'AST' => 0, 'TRB' => 0];
        $averages = ['FG_percent' => 0, 'P3_percent' => 0, 'FT_percent' => 0];
        $strengths = [];
        $weaknesses = [];
        $playerCount = $teamPlayers->count();
        return view('team.index', compact('teamPlayers', 'wins', 'playoffResult', 'totals', 'averages', 'strengths', 'weaknesses', 'playerCount'));
    }

    // Calculate team totals and averages
    $totals = [
        'PTS' => 0, 'AST' => 0, 'TRB' => 0, 'STL' => 0, 'BLK' => 0,
        'FG_percent' => 0, 'P3_percent' => 0, 'FT_percent' => 0, 'MP' => 0
    ];
    
    $playerCount = 0;
    foreach ($teamPlayers as $tp) {
        if ($tp->player) {
            $totals['PTS'] += $tp->player->PTS ?? 0;
            $totals['AST'] += $tp->player->AST ?? 0;
            $totals['TRB'] += $tp->player->TRB ?? 0;
            $totals['STL'] += $tp->player->STL ?? 0;
            $totals['BLK'] += $tp->player->BLK ?? 0;
            $totals['FG_percent'] += $tp->player->FG_percent ?? 0;
            $totals['P3_percent'] += $tp->player->P3_percent ?? 0;
            $totals['FT_percent'] += $tp->player->FT_percent ?? 0;
            $totals['MP'] += $tp->player->MP ?? 0;
            $playerCount++;
        }
    }

    // Calculate averages for percentages
    $averages = [
        'FG_percent' => $playerCount > 0 ? $totals['FG_percent'] / $playerCount : 0,
        'P3_percent' => $playerCount > 0 ? $totals['P3_percent'] / $playerCount : 0,
        'FT_percent' => $playerCount > 0 ? $totals['FT_percent'] / $playerCount : 0,
    ];

    $offensiveRating = ($totals['PTS'] * 0.50) + ($totals['AST'] * 0.25) + ($totals['TRB'] * 0.10);
    $defensiveRating = ($totals['TRB'] * 0.40) + ($totals['STL'] * 0.30) + ($totals['BLK'] * 0.30);
    $efficiencyRating = ($averages['FG_percent'] * 20) + ($averages['P3_percent'] * 10) + ($averages['FT_percent'] * 10);
    $chemistryFactor = min(1.2, 1.0 + ($totals['MP'] / 500));
    
    $sizeFactor = match($playerCount) {
        3 => 0.65,
        4 => 0.85,
        5 => 1.00,
        default => 1.00
    };

    $baseScore = ($offensiveRating * 0.50) + ($defensiveRating * 0.35) + ($efficiencyRating * 0.15);
    $adjustedScore = $baseScore * $chemistryFactor * $sizeFactor;

    $randomFactor = rand(88, 112) / 100;
    $finalScore = $adjustedScore * $randomFactor;

    $wins = min(82, max(0, round($finalScore / 0.95)));


    $playoffResult = match (true) {
        $wins >= 65 => ['NBA Finals', '🏆 Championship contender with elite talent'],
        $wins >= 58 => ['Conference Finals', '🌟 Strong playoff team with great chemistry'],
        $wins >= 52 => ['Playoffs - 2nd Round', '✅ Solid playoff team'],
        $wins >= 45 => ['Playoffs - 1st Round', '📈 Making the playoffs'],
        $wins >= 38 => ['Play-In Tournament', '🎯 On the bubble'],
        default => ['Missed Playoffs', '📉 Needs improvement']
    };

    // Calculate team strengths
    $strengths = [];
    if ($totals['PTS'] > 100) $strengths[] = 'High Scoring';
    if ($totals['AST'] > 25) $strengths[] = 'Great Passing';
    if ($totals['TRB'] > 50) $strengths[] = 'Strong Rebounding';
    if ($totals['STL'] + $totals['BLK'] > 8) $strengths[] = 'Good Defense';
    if ($averages['FG_percent'] > 0.48) $strengths[] = 'Efficient Shooting';
    
    $weaknesses = [];
    if ($totals['PTS'] < 80) $weaknesses[] = 'Low Scoring';
    if ($totals['AST'] < 15) $weaknesses[] = 'Limited Passing';
    if ($totals['TRB'] < 35) $weaknesses[] = 'Weak Rebounding';
    if ($averages['FG_percent'] < 0.42) $weaknesses[] = 'Poor Shooting';

    return view('team.index', compact('teamPlayers', 'wins', 'playoffResult', 'totals', 'averages', 'strengths', 'weaknesses', 'playerCount'));
    }

    public function remove($id)
    {
    TeamPlayer::where('player_id', $id)->delete();
    return redirect()->route('team.index')->with('success', 'Player removed from team.');
    }
}
