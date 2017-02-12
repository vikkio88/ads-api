<?php


namespace App\Actions\Matches;

use App\Lib\AdsLib\MatchSimulator;
use App\Lib\Slime\RestAction\ApiAction;

class MatchesSimulateOne extends ApiAction
{
    protected function performAction()
    {
        $this->payload = MatchSimulator::simulateCompleteResult(
            $this->args['id']
        );
    }
}