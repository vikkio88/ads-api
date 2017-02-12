<?php

use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use App\Lib\AdsLib\LeagueFixtureGenerator;
use App\Models\League;
use App\Models\LeagueRound;
use App\Models\Match;
use App\Models\Team;

class S1486901172Leagues implements DbHelperInterface
{

    public function run()
    {
        $leagues = [
            'friendly' => 16,
            'europa league' => 8
        ];
        $teams = Team::all()->toArray();
        foreach ($leagues as $league => $teamsNum) {

            $teamCopy = $teams;
            $league = League::create(
                [
                    'name' => $league,
                    'teams' => $teamsNum
                ]
            );

            //Create Rounds
            shuffle($teamCopy);
            $teamCopy = array_splice($teamCopy, 0, $teamsNum);
            $rounds = LeagueFixtureGenerator::generate($teamCopy);
            foreach ($rounds as $i => $round) {

                $leagueRound = LeagueRound::create(
                    [
                        'league_id' => $league->id,
                        'day' => $i + 1
                    ]
                );

                foreach ($round as $match) {
                    Match::create(
                        [
                            'home_team_id' => $match['home_team_id'],
                            'away_team_id' => $match['away_team_id'],
                            'league_round_id' => $leagueRound->id
                        ]
                    );
                }
            }
        }
    }

}