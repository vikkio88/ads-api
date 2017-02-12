<?php


namespace App\Actions\Leagues;

use App\Lib\Slime\RestAction\ApiAction;
use App\Lib\Slime\RestAction\Traits\Pagination;
use App\Models\League;

class LeaguesGetAll extends ApiAction
{

    use Pagination;

    protected function performAction()
    {
        $this->pagination = $this->getPaginationParams($this->request);
        $this->payload = League::page(
            $this->pagination
        )->get();
    }
}