<?php


namespace App\Actions\Leagues;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\LeagueRound;

class LeaguesGetOneRound extends ApiAction
{

    protected function performAction()
    {
        $this->payload = LeagueRound::complete()
            ->find($this->args['id']);
    }
}