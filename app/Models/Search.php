<?php

namespace App\Models;

use Scholar\DB;

class Search
{
    public static function start($filter)
    {
        $data = self::doSearch($filter);
        if(empty($data)) {
            echo "No se encontraron coincidencias\n";
            return false;
        }
        $baseClass = Classes::BASE_VALUE;
        foreach ($data as $item) {
            $resource = $value = "" ;
            if($item['resource'] == 'class') {
                $resource = 'Clase';
                $value = "{$item['value']}/{$baseClass}";
            } else {
                $resource = 'Examen';
                $value = Exams::getTypeExam($item['value']);
            }
            echo "{$resource}: {$item['name']} | $value\n";
        }
    }

    public static function doSearch($filter)
    {
        if(strlen($filter) < 3) {
            echo "Error: Filtro de búsqueda debe ser mnimo 3 carácteres\n";
            die;
        }
        $queryClass = "SELECT id, name, weighing as value, 'class' as resource FROM classes WHERE name like '%$filter%'";
        $queryExam = "SELECT id, name, type as value, 'exam' as resource FROM exams WHERE name like '%$filter%'";
        $query = "$queryClass UNION $queryExam ORDER BY id ASC";
        $result = DB::query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        return $data;
    }
}
