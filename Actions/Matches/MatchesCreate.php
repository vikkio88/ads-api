<?php


namespace App\Actions\Matches;

use App\Lib\Slime\RestAction\ApiAction;

class MatchesCreate extends ApiAction
{

    protected function performAction()
    {
        $this->payload = null;
    }
}