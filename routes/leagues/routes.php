<?php

use App\Actions\Leagues\LeaguesGetOne;
use App\Actions\Leagues\LeaguesGetOneRound;
use App\Actions\Leagues\LeaguesSimulateRound;
use App\Actions\Leagues\LeaguesGetAll;

$api->get('/leagues', function ($request, $response, $args) {
    return (new LeaguesGetAll($request, $response, $args))->execute();
});

$api->get('/leagues/{id}', function ($request, $response, $args) {
    return (new LeaguesGetOne($request, $response, $args))->execute();
});

$api->get('/leagues/{id}/rounds/{roundId}', function ($request, $response, $args) {
    return (new LeaguesGetOneRound($request, $response, $args))->execute();
});

$api->get('/leagues/{id}/rounds/{roundId}/simulate', function ($request, $response, $args) {
    return (new LeaguesSimulateRound($request, $response, $args))->execute();
});

