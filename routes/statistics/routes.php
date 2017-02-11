<?php

$api->get('/statistics', function ($request, $response, $args) {
            return (
                new SOMEACTION(
                    $request,
                    $response,
                    $args
                )
             )->execute();
             });
