<?php

$api->get('/teams', function ($request, $response, $args) {
            return (
                new SOMEACTION(
                    $request,
                    $response,
                    $args
                )
             )->execute();
             });
