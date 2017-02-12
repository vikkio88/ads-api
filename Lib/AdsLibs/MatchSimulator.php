<?php


namespace App\Lib\AdsLib;


use App\Libs\AdsLib\SimulationModels\Match as MatchSim;
use App\Models\LeagueRound;
use App\Models\Match;
use App\Models\MatchResult;

class MatchSimulator
{
    /**
     * @param $roundId
     * @return string
     */
    public static function simulateRound($roundId)
    {
        $result = self::getCompleteRound($roundId);
        if (!empty($result)
            &&
            !$result->simulated
        ) {
            $matches = Match::where(
                [
                    'league_round_id' => $roundId
                ]
            )->get();
            foreach ($matches as $match) {
                self::simulateSimpleResult($match->id)->toArray();
            }
            LeagueRound::find($roundId)->update(['simulated' => true]);
            $result = self::getCompleteRound($roundId);
        }
        return $result;
    }

    /**
     * @param $matchId
     * @return mixed
     */
    public static function simulateCompleteResult($matchId)
    {
        $result = self::getCompleteResult($matchId);
        if (!empty($result)
            && !$result->simulated
            && self::simulate($matchId) === 1
        ) {
            $result = self::getCompleteResult($matchId);
        }
        return $result;
    }

    /**
     * @param $matchId
     * @return mixed
     */
    public static function simulateSimpleResult($matchId)
    {
        $result = self::getSimpleResult($matchId);
        if (!empty($result)
            && !$result->simulated
            && self::simulate($matchId) === 1
        ) {
            $result = self::getSimpleResult($matchId);
        }
        return $result;
    }

    /**
     * @param $matchId
     * @return mixed
     */
    private static function simulate($matchId)
    {
        $match = MatchSim::fromArray(
            Match::complete()
                ->where(
                    [
                        'id' => $matchId
                    ]
                )->first()->toArray()
        );
        $matchResult = $match->simulate()->toArray();
        $result = MatchResult::where(
            [
                'id' => $matchId
            ]
        )->update(
            MatchResult::resolveAttributes(
                $matchResult,
                $matchId
            )
        );
        return $result;
    }


    /**
     * @param $matchId
     * @return MatchResult
     */
    private static function getCompleteResult($matchId)
    {
        return MatchResult::complete()->where(
            [
                'id' => $matchId
            ]
        )->first();
    }

    /**
     * @param $matchId
     * @return MatchResult
     */
    private static function getSimpleResult($matchId)
    {
        return MatchResult::teams()->where(
            [
                'id' => $matchId
            ]
        )->first();
    }

    /**
     * @param $roundId
     * @return mixed
     */
    private static function getCompleteRound($roundId)
    {
        return LeagueRound::complete()->where(
            [
                'id' => $roundId
            ]
        )->first();
    }

}