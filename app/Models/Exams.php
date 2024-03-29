<?php

namespace App\Models;

use Scholar\Model;

class Exams extends Model
{
    protected $table = 'exams';
    private static $examsTypes = ['Selección', 'Preguntas y Respuestas', 'Completación'];

    public static function getTypeExam($val)
    {
        return self::$examsTypes[$val - 1];
    }
}
