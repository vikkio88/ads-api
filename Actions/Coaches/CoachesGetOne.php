<?php


namespace App\Actions\Coaches;

use App\Lib\Slime\RestAction\ApiAction;
use App\Models\Coach;

class CoachesGetOne extends ApiAction
{

    protected function performAction()
    {
        $this->payload = Coach::find($this->args['id']);
    }
}