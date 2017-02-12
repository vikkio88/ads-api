<?php


namespace App\Actions\Coaches;

use App\Lib\AdsLib\MatchSimulator;
use App\Lib\Slime\RestAction\ApiAction;

class LeaguesSimulateRound extends ApiAction
{
    protected function performAction()
    {
        $this->payload = MatchSimulator::simulateRound(
            $this->args['roundId']
        );
    }
}