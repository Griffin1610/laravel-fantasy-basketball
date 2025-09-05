<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //
    protected $table = 'nbastats';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
    'Player', 'Age', 'Tm', 'Pos', 'MP', 'FG_percent',
    '3P_percent', '2P_percent', 'FT_percent', 'TRB',
    'AST', 'STL', 'BLK', 'PTS'
];

}
