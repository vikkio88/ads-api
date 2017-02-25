<?php

use App\Actions\Players\PlayerGetOne;

$api->get('/players/{id}', function ($request, $response, $args) {
    return (new PlayerGetOne($request, $response, $args))->execute();
});
