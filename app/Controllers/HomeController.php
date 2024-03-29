<?php

namespace App\Controllers;

class HomeController
{

    public static function test()
    {
        echo 'Scholar working';
    }

    public static function some()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['scholar_data' => ['some' => 'here']]);
    }

    public function dev()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['scholar_data' => ['some' => 'here']]);
    }
}
