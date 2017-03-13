<?php


namespace App\Actions\Statistics;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Player;
use App\Models\Team;

class StatisticsGet extends ApiAction
{

    protected function performAction()
    {
        $this->payload = [
            'scorers' => Player::getBestScorers(),
            'avg' => Player::getBestAvg(),
            'teams' => Team::getBest()
        ];
    }
}