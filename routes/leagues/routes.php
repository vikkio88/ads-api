<?php

use App\Actions\Leagues\LeaguesGetOne;
use App\Actions\Leagues\LeaguesGetOneRound;
use App\Actions\Leagues\LeaguesSimulateRound;
use App\Actions\Leagues\LeaguesGetAll;

$api->get('/leagues', LeaguesGetAll::class);

$api->get('/leagues/{id}', LeaguesGetOne::class);

$api->get('/leagues/{id}/rounds/{roundId}', LeaguesGetOneRound::class);

$api->get('/leagues/{id}/rounds/{roundId}/simulate', LeaguesSimulateRound::class);
