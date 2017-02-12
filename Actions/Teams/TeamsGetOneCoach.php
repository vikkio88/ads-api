<?php


namespace App\Actions\Teams;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Team;

class TeamsGetOneCoach extends ApiAction
{

    protected function performAction()
    {
        $this->payload = Team::with('coach')
            ->where('id', $this->args['id'])
            ->get();
    }
}