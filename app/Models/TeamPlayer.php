<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamPlayer extends Model
{
    protected $fillable = ['player_id'];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }
}
