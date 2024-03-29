<?php

use Scholar\Scholar;

$app = new Scholar();
$app::get('/', 'HomeController', 'test');
$app::get('/some', 'HomeController', 'some');
$app::post('/', 'HomeController', 'test');
$app::post('/dev', 'HomeController', 'dev');
$app->run();
