<?php

use App\Actions\Players\PlayerGetOne;

$api->get('/players/{id}', PlayerGetOne::class);