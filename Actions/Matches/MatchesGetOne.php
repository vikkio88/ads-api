<?php


namespace App\Actions\Matches;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Match;

class MatchesGetOne extends ApiAction
{

    protected function performAction()
    {
        $this->payload = Match::complete()
            ->find($this->args['id']);
    }
}