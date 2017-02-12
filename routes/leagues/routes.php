<?php

$api->get('/leagues', function ($request, $response, $args) {
    return (new CoachesGetAll($request, $response, $args))->execute();
});

$api->get('/leagues/{id}', function ($request, $response, $args) {
    return (new CoachesGetOne($request, $response, $args))->execute();
});

$api->get('/leagues/{id}/rounds/{roundId}', function ($request, $response, $args) {
    return (new CoachesGetOne($request, $response, $args))->execute();
});

$api->get('/leagues/{id}/rounds/{roundId}/simulate', function ($request, $response, $args) {
    return (new CoachesGetOne($request, $response, $args))->execute();
});

