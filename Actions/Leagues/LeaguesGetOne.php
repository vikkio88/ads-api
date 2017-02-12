<?php


namespace App\Actions\Leagues;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\League;

class LeaguesGetOne extends ApiAction
{

    protected function performAction()
    {
        $this->payload = League::with('rounds')
            ->find($this->args['id']);
    }
}