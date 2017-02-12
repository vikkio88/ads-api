<?php


namespace App\Actions\Teams;

use App\Lib\Slime\RestAction\ApiAction;
use App\Lib\Slime\RestAction\Traits\Pagination;
use App\Models\Team;

class TeamsGetAll extends ApiAction
{

    use Pagination;

    protected function performAction()
    {
        $this->pagination = $this->getPaginationParams($this->request);
        $this->payload = Team::page(
            $this->pagination
        )->get();
    }
}