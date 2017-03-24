<?php

use App\Actions\Teams\TeamsGetAll;
use App\Actions\Teams\TeamsGetOne;
use App\Actions\Teams\TeamsGetOneCoach;
use App\Actions\Teams\TeamsGetOneWithMatches;
use App\Actions\Teams\TeamsGetOneWithRoster;

$api->get('/teams', TeamsGetAll::class);

$api->get('/teams/{id}', TeamsGetOne::class);

$api->get('/teams/{id}/matches', TeamsGetOneWithMatches::class);

$api->get('/teams/{id}/roster', TeamsGetOneWithRoster::class);

$api->get('/teams/{id}/coach', TeamsGetOneCoach::class);

