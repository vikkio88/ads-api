<?php


use App\Actions\Coaches\CoachesGetAll;
use App\Actions\Coaches\CoachesGetOne;

$api->get('/coaches', function ($request, $response, $args) {
    return (new CoachesGetAll($request, $response, $args))->execute();
});

$api->get('/coaches/{id}', function ($request, $response, $args) {
    return (new CoachesGetOne($request, $response, $args))->execute();
});
