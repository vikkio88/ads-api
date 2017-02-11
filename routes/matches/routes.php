<?php

$api->get('/matches', function ($request, $response, $args) {
            return (
                new SOMEACTION(
                    $request,
                    $response,
                    $args
                )
             )->execute();
             });
