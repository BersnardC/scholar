<?php

namespace Scholar;

use Scholar\DB;

class Model extends DB
{
    protected $table;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get data for table
     * @param string $str_select Values to select
     * @param array $filters Filters to apply where
     * @return array
     */
    public function get(string $str_select = '*', array $filters = [])
    {
        $query = "SELECT $str_select FROM {$this->table}";
        if (count($filters)) {
            $str_filters = $this->parseFilters($filters);
            $query .= " WHERE $str_filters";
        }
        $result = parent::getConnection()->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        return $data;
    }

    /**
     * Create a new record in table
     * @param array $data Data for record
     * @return null|array
     */
    public function create(array $data)
    {
        $keys = implode(',', array_keys($data));
        $values = $this->parseCreateValues(array_values($data));
        $query = "INSERT INTO {$this->table}($keys) VALUES ($values);";
        $result = parent::getConnection()->query($query);
        if ($result) {
            $data['id'] = parent::getConnection()->insert_id;
            return (object) $data;
        }
        return null;
    }

    /**
     * Create a bulk insert in table
     * @param array $data Data for save
     * @return integer
     */
    public function bulkInsert(array $data)
    {
        $keys = implode(',', array_keys($data[0]));
        $str_values = "";
        foreach ($data as $item) {
            $str_values .= $str_values ? ", " : "";
            $values = $this->parseCreateValues(array_values($item));
            $str_values .= "($values)";
        }
        $query = "INSERT INTO {$this->table}($keys) VALUES $str_values;";
        $result = parent::getConnection()->query($query);
        return parent::getConnection()->affected_rows;
    }

    /**
     * Update record table
     * @param array $data Data to update
     * @param array $filters Filters to apply where
     * @return integer
     */
    public function update(array $data, array $filters = [])
    {
        $values = $this->parseUpdateValues($data);
        $query = "UPDATE {$this->table} SET $values";
        if (count($filters)) {
            $str_filters = $this->parseFilters($filters);
            $query .= " WHERE $str_filters";
        }
        $result = parent::getConnection()->query($query);
        return parent::getConnection()->affected_rows;
    }

    /**
     * Delete record of table
     * @param array $filters Filter to apply where
     * @return integer
     */
    public function delete(array $filters = [])
    {
        $query = "DELETE FROM {$this->table}";
        if (count($filters)) {
            $str_filters = $this->parseFilters($filters);
            $query .= " WHERE $str_filters";
        }
        $result = parent::getConnection()->query($query);
        return parent::getConnection()->affected_rows;
    }
}
