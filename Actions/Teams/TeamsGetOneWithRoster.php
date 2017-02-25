<?php


namespace App\Actions\Teams;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Team;

class TeamsGetOneWithRoster extends ApiAction
{

    protected function performAction()
    {
        $this->payload = Team::with('roster')
            ->where('id', $this->args['id'])
            ->first();
    }
}