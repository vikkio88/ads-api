<?php


namespace App\Actions\User;

use App\Lib\Slime\RestAction\ApiAction;
use App\Lib\Slime\RestAction\Traits\Pagination;
use App\Models\Coach;

class CoachesGetOne extends ApiAction
{

    protected function performAction()
    {
        $this->payload = Coach::find($this->args['id']);
    }
}