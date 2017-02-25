<?php

namespace App\Actions\Teams;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Team;

class TeamsGetOneWithMatches extends ApiAction
{
    protected function performAction()
    {
        $this->payload = Team::allMatches()
            ->where('id', $this->args['id'])
            ->first();
    }
}