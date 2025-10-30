<?php

namespace App\Http\Controllers;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    
    public function index(Request $request)
    {
    $sort = $request->query('sort');
    $query = Player::query();

    if (in_array($sort, ['MP', 'PTS', 'AST'])) {
        $query->orderByDesc($sort);
    }
    $players = $query->get();
    return view('players.index', compact('players', 'sort'));
    }
}
