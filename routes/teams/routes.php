<?php

use App\Actions\Teams\TeamsGetAll;
use App\Actions\Teams\TeamsGetOne;
use App\Actions\Teams\TeamsGetOneCoach;
use App\Actions\Teams\TeamsGetOnePlayer;
use App\Actions\Teams\TeamsGetOneWithRoster;

$api->get('/teams', function ($request, $response, $args) {
    return (new TeamsGetAll($request, $response, $args))->execute();
});

$api->get('/teams/{id}', function ($request, $response, $args) {
    return (new TeamsGetOne($request, $response, $args))->execute();
});

$api->get('/teams/{id}/players', function ($request, $response, $args) {
    return (new TeamsGetOneWithRoster($request, $response, $args))->execute();
});

$api->get('/teams/{id}/coach', function ($request, $response, $args) {
    return (new TeamsGetOneCoach($request, $response, $args))->execute();
});

$api->get('/teams/{id}/players/{playerId}', function ($request, $response, $args) {
    return (new TeamsGetOnePlayer($request, $response, $args))->execute();
});
