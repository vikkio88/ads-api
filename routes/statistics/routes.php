<?php

use App\Actions\Statistics\StatisticsGet;

$api->get('/statistics', StatisticsGet::class);