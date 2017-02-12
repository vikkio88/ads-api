<?php

use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use App\Libs\AdsLib\RandomFiller;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Team;

class S1486901165Teams implements DbHelperInterface
{

    public function run()
    {
        $teamNumber = 16;
        $rndFiller = new RandomFiller();
        for ($i = 1; $i <= $teamNumber; $i++) {
            $team = $rndFiller->getTeam($rndFiller->getLocale());
            $teamArray = $team->toArray();
            $teamO = Team::create($teamArray);
            foreach ($teamArray['roster'] as $player) {
                $player['team_id'] = $teamO->id;
                Player::create($player);
            }
            $teamArray['coach']['team_id'] = $teamO->id;
            Coach::create($teamArray['coach']);
        }
    }

}