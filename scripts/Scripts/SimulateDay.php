<?php


namespace App\Scripts;


use App\Lib\AdsLib\MatchSimulator;
use App\Models\LeagueRound;
use App\Models\Match;
use Carbon\Carbon;
use Mashtru\Libs\Interfaces\Job;

class SimulateDay implements Job
{
    private $now = null;

    public function fire(array $parameters = [])
    {
        $this->now = Carbon::now();

        if ($this->now->hour >= 4 && $this->now->hour < 23) {
            return false;
        }
        $this->simulateMatches();
    }

    public function getName()
    {
        return "simulateDay";
    }

    private function simulateMatches()
    {
        $matches = Match::where('date', '<', $this->now->addDay()->toDateString())->get();
        $roundIds = [];
        foreach ($matches as $match) {
            MatchSimulator::simulateCompleteResult($match->id);
            $roundIds[$match->league_round_id] = true;
        }

        if (!empty($roundIds)) {
            $simulatedRound = LeagueRound::whereDoesntHave(
                'matches',
                function ($query) {
                    $query->where('simulated', false);
                }
            )->whereIn('id', array_keys($roundIds))->get();

            foreach ($simulatedRound as $round) {
                $round->simulated = true;
                $round->save();
            }
        }
    }
}