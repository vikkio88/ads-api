<?php

namespace App\Actions\Players;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Player;

class PlayerGetOne extends ApiAction
{
    protected function performAction()
    {
        $this->payload = Player::statistics()->where(
            [
                'id' => $this->args['id']
            ]
        )->first();
    }
}