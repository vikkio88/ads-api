<?php


namespace App\Scripts;


use App\Lib\AdsLib\MatchSimulator;
use App\Models\LeagueRound;
use Carbon\Carbon;
use Mashtru\Libs\Interfaces\Job;

class SimulateDay implements Job
{

    public function fire(array $parameters = [])
    {
        $now = Carbon::now();
        /*
        if ($now->hour >= 4 && $now->hour > 22) {
            return false;
        }
        */

        $rounds = LeagueRound::where('date', '<', $now->toDateString())->get();
        foreach ($rounds as $round) {
            MatchSimulator::simulateRound($round->id);
        }

    }

    public function getName()
    {
        return "simulateDay";
    }
}