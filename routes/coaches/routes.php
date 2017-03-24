<?php


use App\Actions\Coaches\CoachesGetAll;
use App\Actions\Coaches\CoachesGetOne;

$api->get('/coaches', CoachesGetAll::class);

$api->get('/coaches/{id}', CoachesGetOne::class);
