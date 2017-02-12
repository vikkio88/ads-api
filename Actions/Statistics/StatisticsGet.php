<?php


namespace App\Actions\User;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Player;
use App\Models\Team;

class StatisticsGet extends ApiAction
{

    protected function performAction()
    {
        $this->payload = [
            'players' => Player::getBest(),
            'teams' => Team::getBest()
        ];
    }
}