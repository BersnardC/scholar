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

    /**
     * Set a new connection DB
     * @return void
     */
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

    /**
     * Return connection instance
     * @return mysqli instance
     */
    protected static function getConnection()
    {
        return self::$connection;
    }

    /**
     * Run a new query
     * @param string $query Query to run
     * @return object
     */
    public static function query(string $query)
    {
        self::connect();
        $result = self::$connection->query($query);
        return $result;
    }

    /**
     * Parse values from array for insert query
     * Used in create method
     * @param array $data_values Values to insert
     * @return string
     */
    public static function parseCreateValues(array $data_values): string
    {
        $values = "";
        foreach($data_values as $val) {
            if($values != '') $values .= ', ';
            $values .= gettype($val) == 'string' ? "'$val'" : "$val";
        }
        return $values;
    }

    /**
     * Parse values from array for update query
     * Used in update method
     * @param array $data Values to update
     * @return string
     */
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

    /**
     * Parse values from array for filters where
     * Used in query where
     * @param array $filters Values to filters
     * @return string
     */
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
