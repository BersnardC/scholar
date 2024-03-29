<?php

use Scholar\Scholar;

$app = new Scholar();
$app::get('/', 'HomeController', 'welcome');
$app::get('/classes', 'HomeController', 'getClasses');
$app::get('/exams', 'HomeController', 'getExams');
$app::post('/dev', 'HomeController', 'dev');
$app->run();
