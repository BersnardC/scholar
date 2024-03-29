<?php

namespace App\Controllers;

use App\Models\Classes;
use App\Models\Exams;

class HomeController
{

    public static function welcome()
    {
        echo '<h1>Welcome to Scholar</h1>';
    }

    public static function getClasses()
    {
        header('Content-Type: application/json; charset=utf-8');
        $classes = new Classes();
        echo json_encode(['classes' => $classes->get()]);
    }

    public static function getExams()
    {
        header('Content-Type: application/json; charset=utf-8');
        $exams = new Exams();
        echo json_encode(['exams' => $exams->get()]);
    }

    public function dev()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['scholar_data' => ['some' => 'here']]);
    }
}
