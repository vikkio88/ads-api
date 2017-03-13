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
            ->orderBy('date', 'ASC')
            ->limit(self::PLAYED_LIMIT);
    }

    public function futureMatchesHome()
    {
        return $this->hasMany(
            MatchResult::class,
            'home_team_id'
        )->where('simulated', false)
            ->orderBy('date', 'ASC')
            ->limit(self::FUTURE_LIMIT);
    }

    public function playedMatchesAway()
    {
        return $this->hasMany(
            MatchResult::class,
            'away_team_id'
        )->where('simulated', true)
            ->orderBy('date', 'ASC')
            ->limit(self::PLAYED_LIMIT);
    }

    public function futureMatchesAway()
    {
        return $this->hasMany(
            MatchResult::class,
            'away_team_id'
        )->where('simulated', false)
            ->orderBy('date', 'ASC')
            ->limit(self::FUTURE_LIMIT);
    }

    public function scopeAllMatches($query)
    {
        return $query->with(
            'playedMatchesHome',
            'playedMatchesHome.round',
            'playedMatchesHome.awayTeam',
            'futureMatchesHome',
            'futureMatchesHome.round',
            'futureMatchesHome.awayTeam',
            'playedMatchesAway',
            'playedMatchesAway.round',
            'playedMatchesAway.homeTeam',
            'futureMatchesAway',
            'futureMatchesAway.round',
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
        $stats = Match::selectRaw('winner_id, COUNT(*) as won')
            ->whereNotNull('winner_id')->where('winner_id', '!=', 0)
            ->orderByRaw('COUNT(*) DESC')->groupBy('winner_id')
            ->take(self::TEAM_STATS_LIMIT)->get()->keyBy('winner_id')->toArray();
        return self::mergeStats($stats);
    }

    private static function mergeStats($stats)
    {
        $result = [];
        $teams = Team::whereIn('id', array_keys($stats))
            ->get()
            ->keyBy('id')
            ->toArray();

        foreach ($stats as $teamId => $stat){
            unset($stat['team_id']);
            $result[] = array_merge(
                $teams[$teamId],
                $stat
            );
        }
        return $result;
    }

}