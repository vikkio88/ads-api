<?php


namespace App\Actions\Coaches;

use App\Lib\Slime\RestAction\ApiAction;
use App\Lib\Slime\RestAction\Traits\Pagination;
use App\Models\Coach;

class CoachesGetAll extends ApiAction
{

    use Pagination;

    protected function performAction()
    {
        $this->pagination = $this->getPaginationParams($this->request);
        $this->payload = Coach::page(
            $this->pagination
        )->get();
    }
}