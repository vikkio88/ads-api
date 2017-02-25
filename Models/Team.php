<?php

namespace App\Models;

use App\Lib\Slime\Models\SlimeModel;

class Team extends SlimeModel
{
    const PLAYED_LIMIT = 5;
    const FUTURE_LIMIT = 3;
    const TEAM_STATS_LIMIT = 5;

    protected $fillable = [
        'name',
        'nationality'
    ];

    public function roster()
    {
        return $this->hasMany(Player::class);
    }

    public function coach()
    {
        return $this->hasOne(Coach::class);
    }

    public function playedMatchesHome()
    {
        return $this->hasMany(
            MatchResult::class,
            'home_team_id'
        )->where('simulated', true)
            ->orderBy('updated_at', 'DESC')
            ->limit(self::PLAYED_LIMIT);
    }

    public function futureMatchesHome()
    {
        return $this->hasMany(
            MatchResult::class,
            'home_team_id'
        )->where('simulated', false)
            ->orderBy('updated_at', 'DESC')
            ->limit(self::FUTURE_LIMIT);
    }

    public function playedMatchesAway()
    {
        return $this->hasMany(
            MatchResult::class,
            'away_team_id'
        )->where('simulated', true)
            ->orderBy('updated_at', 'DESC')
            ->limit(self::PLAYED_LIMIT);
    }

    public function futureMatchesAway()
    {
        return $this->hasMany(
            MatchResult::class,
            'away_team_id'
        )->where('simulated', false)
            ->orderBy('updated_at', 'DESC')
            ->limit(self::FUTURE_LIMIT);
    }

    public function scopeAllMatches($query)
    {
        return $query->with(
            'playedMatchesHome',
            'playedMatchesHome.awayTeam',
            'futureMatchesHome',
            'futureMatchesHome.awayTeam',
            'playedMatchesAway',
            'playedMatchesAway.homeTeam',
            'futureMatchesAway',
            'futureMatchesAway.homeTeam'
        );
    }

    public function scopeComplete($query)
    {
        return $query->allMatches()
            ->with(
                'roster',
                'coach'
            );
    }

    public static function getBest()
    {
        $result = Match::selectRaw('winner_id, COUNT(*) as won')
            ->whereNotNull('winner_id')->where('winner_id', '!=', 0)
            ->orderByRaw('COUNT(*) DESC')->groupBy('winner_id')
            ->take(self::TEAM_STATS_LIMIT)->get()->keyBy('winner_id')->toArray();
        $teams = Team::whereIn('id', array_keys($result))->get()->toArray();
        $result = array_map(function ($team) use ($result) {
            return array_merge($team, $result[$team['id']]);

        }, $teams);

        return $result;
    }

}