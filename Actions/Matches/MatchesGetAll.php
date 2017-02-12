<?php


namespace App\Actions\Matches;

use App\Lib\Slime\RestAction\ApiAction;
use App\Lib\Slime\RestAction\Traits\Pagination;
use App\Models\Match;

class MatchesGetAll extends ApiAction
{
    use Pagination;

    protected function performAction()
    {
        $this->pagination = $this->getPaginationParams($this->request);
        $this->payload = Match::teams()
            ->page($this->pagination)
            ->get();
    }
}