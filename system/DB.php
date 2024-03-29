<?php

namespace Scholar;

use mysqli;
use Exception;

class DB
{
    private static $connection;

    public function __construct()
    {
        self::connect();
    }

    private static function connect()
    {
        if (self::$connection) return self::$connection;
        $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
        if ($conn->connect_error) {
            throw new Exception(mysqli_connect_error());
        } else {
            $conn->query("SET NAMES 'utf8'");
            self::$connection = $conn;
        }
    }

    protected static function getConnection()
    {
        return self::$connection;
    }

    public static function query(string $query)
    {
        self::connect();
        $result = self::$connection->query($query);
        return $result;
    }

    public static function parseCreateValues(array $str_values): string
    {
        $values = "";
        foreach($str_values as $val) {
            if($values != '') $values .= ', ';
            $values .= gettype($val) == 'string' ? "'$val'" : "$val";
        }
        return $values;
    }

    public static function parseUpdateValues(array $data): string
    {
        $values = "";
        foreach ($data as $key => $val) {
            if ($values != '') $values .= ', ';
            $values .= "$key=";
            $values .= gettype($val) == 'string' ? "'$val'" : "$val";
        }
        return $values;
    }

    public static function parseFilters(array $filters): string
    {
        $str_filters = "";
        foreach ($filters as $key => $val) {
            if ($str_filters != '') $str_filters .= ' and ';
            $str_filters .= "$key=";
            $str_filters .= gettype($val) == 'string' ? "'$val'" : "$val";
        }
        return $str_filters;
    }
}
