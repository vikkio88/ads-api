<?php

namespace App\Models;

use App\Lib\Slime\Models\SlimeModel;

class Match extends SlimeModel
{
    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'date',
        'league_round_id'
    ];

    protected $hidden = [
        'home_team_id',
        'away_team_id',
        'created_at',
        'updated_at',
        'winner_id',
        'loser_id',
        'is_draw',
    ];

    protected $casts = [
        'simulated' => 'boolean'
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function scopeTeams($query)
    {
        return $query->with(
            'homeTeam',
            'awayTeam'
        );
    }

    public function scopeComplete($query)
    {
        return $query->with(
            'homeTeam',
            'homeTeam.roster',
            'homeTeam.coach',
            'awayTeam',
            'awayTeam.roster',
            'awayTeam.coach'
        );
    }
}