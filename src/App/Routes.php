<?php

declare(strict_types=1);

$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');

$app->get('/employee', App\Controller\Employee\GetAll::class);
$app->post('/employee', App\Controller\Employee\Create::class);
$app->get('/employee/{id}', App\Controller\Employee\GetOne::class);
$app->put('/employee/{id}', App\Controller\Employee\Update::class);
$app->delete('/employee/{id}', App\Controller\Employee\Delete::class);
