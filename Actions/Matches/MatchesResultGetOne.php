<?php


namespace App\Actions\Matches;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\MatchResult;

class MatchesResultGetOne extends ApiAction
{

    protected function performAction()
    {
        $this->payload = MatchResult::complete()
            ->find($this->args['id']);
    }
}