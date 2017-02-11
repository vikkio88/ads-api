<?php

namespace App\Models;

use App\Lib\Slime\Models\SlimeModel;

class League extends SlimeModel
{
    protected $fillable = [
        'name',
        'teams'
    ];

    public function rounds()
    {
        return $this->hasMany(LeagueRound::class);
    }
}