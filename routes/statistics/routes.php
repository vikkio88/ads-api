<?php

use App\Actions\User\StatisticsGet;

$api->get('/statistics', function ($request, $response, $args) {
    return (new StatisticsGet($request, $response, $args))->execute();
});
