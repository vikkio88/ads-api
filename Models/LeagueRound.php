<?php

namespace App\Models;

use App\Lib\Slime\Models\SlimeModel;

class LeagueRound extends SlimeModel
{
    protected $fillable = [
        'league_id',
        'day',
        'simulated'
    ];

    protected $casts = [
        'simulated' => 'boolean'
    ];

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function matches()
    {
        return $this->hasMany(Match::class);
    }

    public function scopeComplete($query)
    {
        return $query->with(
            'league',
            'matches',
            'matches.homeTeam',
            'matches.AwayTeam'
        );
    }
}