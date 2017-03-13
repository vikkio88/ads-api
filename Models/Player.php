<?php

namespace App\Models;

use App\Lib\Slime\Models\SlimeModel;

class Player extends SlimeModel
{
    const PLAYER_STATS_LIMIT = 5;

    protected $fillable = [
        'name',
        'surname',
        'age',
        'nationality',
        'skillAvg',
        'wageReq',
        'val',
        'role',
        'team_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function lastMatches()
    {
        return $this->hasMany(MatchPlayer::class)
            ->orderBy('updated_at', 'DESC')
            ->limit(5);
    }

    public function goals()
    {
        return $this->hasOne(MatchPlayer::class)
            ->selectRaw('player_id, sum(goals) as count')
            ->groupBy('player_id');
    }

    public function appearances()
    {
        return $this->hasOne(MatchPlayer::class)
            ->selectRaw('player_id, count(match_id) as count')
            ->groupBy('player_id');
    }

    public function avg()
    {
        return $this->hasOne(MatchPlayer::class)
            ->selectRaw('player_id, round(avg(vote),2) as avg')
            ->groupBy('player_id');
    }

    public function scopeStatistics($query)
    {
        return $query->with(
            'goals',
            'appearances',
            'avg',
            'lastMatches',
            'team'
        );
    }

    public static function getBestAvg()
    {
        $stats = MatchPlayer::selectRaw(
            'player_id, AVG(vote) as avg, COUNT(*) as appearances'
        )->where('goals', '>', 0)
            ->orderByRaw('AVG(vote) DESC')
            ->groupBy('player_id')->take(self::PLAYER_STATS_LIMIT)->get()->keyBy('player_id')->toArray();
        return self::mergeStats($stats);
    }

    public static function getBestScorers()
    {
        $stats = MatchPlayer::selectRaw(
            'player_id, SUM(goals) goals, COUNT(*) as appearances'
        )->where('goals', '>', 0)
            ->orderByRaw('SUM(goals) DESC')
            ->groupBy('player_id')->take(self::PLAYER_STATS_LIMIT)->get()->keyBy('player_id')->toArray();
        return self::mergeStats($stats);
    }

    private static function mergeStats($stats)
    {
        $result = [];
        $players = Player::with('team')
            ->whereIn('id', array_keys($stats))
            ->get()
            ->keyBy('id')
            ->toArray();

        foreach ($stats as $playerId => $stat){
            unset($stat['player_id']);
            $result[] = array_merge(
                $players[$playerId],
                $stat
            );
        }
        return $result;
    }
}