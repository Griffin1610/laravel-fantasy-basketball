<?php

namespace App\Http\Controllers;
use App\Models\Player;
use App\Models\TeamPlayer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    
    public function index(Request $request)
    {
    $sort = $request->query('sort');
    $search = $request->query('search');
    $query = Player::query();

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('Player', 'like', '%' . $search . '%')
              ->orWhere('Tm', 'like', '%' . $search . '%');
        });
    }

    $sortableFields = ['MP', 'PTS', 'AST', 'TRB', 'STL', 'BLK', 'FG_percent', 'FT_percent', 'P3_percent'];
    if (in_array($sort, $sortableFields)) {
        $query->orderByDesc($sort);
    }
    
    $players = $query->get();
    $teamPlayerCount = TeamPlayer::count();
    
    return view('players.index', compact('players', 'sort', 'search', 'teamPlayerCount'));
    }
}
