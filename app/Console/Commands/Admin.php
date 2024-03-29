<?php

namespace App\Console\Commands;

use App\Models\Classes;
use App\Models\Exams;
use Scholar\Command;


class Admin extends Command
{
    protected $params = "{action}";
    public function handle()
    {
        $action = $this->param('action');
        if (!$action) {
            echo "Error: ingrese parámetro de acción\n";
            return false;
        }
        switch($action) {
            case "seed": 
                self::seed();
                break;
            default:
                echo "Action not registered\n";
                break;
        }
    }

    private static function seed()
    {
        $themes = ['Matemáticas', 'Inglés', 'Geografía', 'Programación', 'Inteligencia Artificial', 'Marketing'];
        $activities = [
            'Ensayo y Trabajo de', 'Ensayo y Práctica de', 'Práctica grupal de', 'Práctica individual de', 'Trabajos y Ocupaciones sobre',
            'Aplicaciones generales sobre', 'Incidencias actuales en', 'Estudios modernos en', 'Ocupaciones en'
        ];
        $total = 500;
        $exams = $classes = [];
        for ($i = 0; $i < $total; $i++) {
            $date = date('Y-m-d H:i:s');
            # New exam
            $exam = ['name' => self::generateName($themes, $activities), 'type' => rand(1, 3), 'created_at' => $date];
            $exams[] = $exam;
            # New class
            $class = ['name' => self::generateName($themes, $activities), 'weighing' => rand(1, 5), 'created_at' => $date];
            $classes[] = $class;
        }
        # Insert data
        $examsObj = new Exams();
        $resultE = $examsObj->bulkInsert($exams);
        $classesObj = new Classes();
        $resultC = $classesObj->bulkInsert($classes);
        echo "$resultE examenes registrados\n";
        echo "$resultC clases registradas\n";
    }

    private static function generateName(array $themes, array $activities)
    {
        $theme = $themes[rand(0, count($themes) - 1)];
        $activity = $activities[rand(0, count($activities) - 1)];
        return "$activity $theme";
    }
}
