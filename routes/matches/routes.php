<?php

use App\Actions\Matches\MatchesCreate;
use App\Actions\Matches\MatchesGetAll;
use App\Actions\Matches\MatchesGetOne;
use App\Actions\Matches\MatchesResultGetOne;
use App\Actions\Matches\MatchesSimulateOne;

$api->get('/matches', MatchesGetAll::class);

$api->post('/matches', MatchesCreate::class);

$api->get('/matches/{id}', MatchesResultGetOne::class);

$api->get('/matches/{id}/simulate', MatchesSimulateOne::class);
