<?php

use App\Actions\Matches\MatchesCreate;
use App\Actions\Matches\MatchesGetAll;
use App\Actions\Matches\MatchesGetOne;
use App\Actions\Matches\MatchesResultGetOne;
use App\Actions\Matches\MatchesSimulateOne;

$api->get('/matches', function ($request, $response, $args) {
    return (new MatchesGetAll($request, $response, $args))->execute();
});

$api->post('/matches', function ($request, $response, $args) {
    return (new MatchesCreate($request, $response, $args))->execute();
});

$api->get('/matches/{id}', function ($request, $response, $args) {
    return (new MatchesResultGetOne($request, $response, $args))->execute();
});

$api->get('/matches/{id}/simulate', function ($request, $response, $args) {
    return (new MatchesSimulateOne($request, $response, $args))->execute();
});

