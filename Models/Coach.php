<?php

namespace App\Models;

use App\Lib\Slime\Models\SlimeModel;

class Coach extends SlimeModel
{
    protected $fillable = [
        'name',
        'surname',
        'age',
        'nationality',
        'skillAvg',
        'wageReq',
        'favouriteModule',
        'team_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}