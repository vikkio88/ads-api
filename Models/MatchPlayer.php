<?php

namespace App\Models;

use App\Lib\Slime\Models\SlimeModel;

class MatchPlayer extends SlimeModel
{
    protected $fillable = [
        'match_id',
        'team_id',
        'player_id',
        'goals',
        'vote'
    ];

    protected $casts = [
        'vote' => 'integer',
        'goals' => 'integer'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function scopeComplete($query)
    {
        return $query->with(
            'team',
            'player'
        );
    }

}