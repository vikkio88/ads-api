<?php


namespace App\Actions\Matches;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Match;

class MatchesCreate extends ApiAction
{

    protected function performAction()
    {
        $this->payload = Match::create(
            $this->getJsonRequestBody()
        );
    }
}