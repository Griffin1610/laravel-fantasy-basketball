<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    protected $table = 'players';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'Rk', 'Player', 'Pos', 'Age', 'Tm', 'G', 'GS', 'MP',
        'FG', 'FGA', 'FG_percent', 'P3', 'P3A', 'P3_percent',
        'P2', 'P2A', 'P2_percent', 'eFG_percent', 'FT', 'FTA',
        'FT_percent', 'ORB', 'DRB', 'TRB', 'AST', 'STL', 'BLK',
        'TOV', 'PF', 'PTS'
    ];

}
