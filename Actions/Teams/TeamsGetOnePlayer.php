<?php


namespace App\Actions\Teams;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Player;

class TeamsGetOnePlayer extends ApiAction
{

    protected function performAction()
    {
        $this->payload = Player::statistics()->where(
            [
                'id' => $this->args['playerId'],
                'team_id' => $this->args['id']
            ]
        )->get();
    }
}