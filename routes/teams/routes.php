<?php

use App\Actions\Teams\TeamsGetAll;
use App\Actions\Teams\TeamsGetOne;
use App\Actions\Teams\TeamsGetOneCoach;
use App\Actions\Teams\TeamsGetOneWithMatches;
use App\Actions\Teams\TeamsGetOneWithRoster;

$api->get('/teams', function ($request, $response, $args) {
    return (new TeamsGetAll($request, $response, $args))->execute();
});

$api->get('/teams/{id}', function ($request, $response, $args) {
    return (new TeamsGetOne($request, $response, $args))->execute();
});

$api->get('/teams/{id}/matches', function ($request, $response, $args) {
    return (new TeamsGetOneWithMatches($request, $response, $args))->execute();
});

$api->get('/teams/{id}/roster', function ($request, $response, $args) {
    return (new TeamsGetOneWithRoster($request, $response, $args))->execute();
});

$api->get('/teams/{id}/coach', function ($request, $response, $args) {
    return (new TeamsGetOneCoach($request, $response, $args))->execute();
});

