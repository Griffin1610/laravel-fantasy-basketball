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


    public function create()
    {
        return view('players.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            //using regex for player and team to satisy requirement and stop invalid player names
            'Player' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s\.\'-]+$/'],
            'Age' => 'nullable|integer',
            'Tm' => ['nullable', 'regex:/^[A-Z]{2,5}$/'],
            'Pos' => 'nullable|string|max:5',
            'MP' => 'nullable|numeric',
            'FG_percent' => 'nullable|numeric',
            '3P_percent' => 'nullable|numeric',
            '2P_percent' => 'nullable|numeric',
            'FT_percent' => 'nullable|numeric',
            'TRB' => 'nullable|numeric',
            'AST' => 'nullable|numeric',
            'STL' => 'nullable|numeric',
            'BLK' => 'nullable|numeric',
            'PTS' => 'nullable|numeric',
        ]);
        Player::create($request->except('_token'));

Player::create($request->except('_token'));


        Player::create($request->all());

        return redirect()->route('players.index')->with('success', 'Player added!');
    }

    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

    public function update(Request $request, Player $player)
    {
        $request->validate([
            //changed to regex expression for requirements and stop invalid player names
            'Player' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s\.\'-]+$/'],
            'PTS' => 'required|numeric',
        ]);

        $player->update($request->all());

        return redirect()->route('players.index')->with('success', 'Player updated!');
    }

    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player deleted!');
    }
}
