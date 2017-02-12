<?php

use App\Actions\User\CoachesGetAll;
use App\Actions\User\CoachesGetOne;

$api->get('/coaches', function ($request, $response, $args) {
    return (new CoachesGetAll($request, $response, $args))->execute();
});

$api->get('/coaches/{id}', function ($request, $response, $args) {
    return (new CoachesGetOne($request, $response, $args))->execute();
});
