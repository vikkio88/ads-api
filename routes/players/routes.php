<?php

$api->get('/players', function ($request, $response, $args) {
            return (
                new SOMEACTION(
                    $request,
                    $response,
                    $args
                )
             )->execute();
             });
