<?php

namespace App\Models\Contract;

class BaseModel implements CRUD
{
    public static $conn;
    public static $table;
    public static $primary_key = 'id';

    public function __construct()
    {
        global $medoo;
        self::$conn = $medoo;
    }

    public function create($data)
    {
        self::$conn->insert(static::$table, $data);
        return self::$conn->id();
    }
    public function read($columns = '*', $where = array())
    {
        return self::$conn->select(static::$table, $columns, $where);
    }

    public function update($data, $where)
    {
        $result = self::$conn->update(static::$table, $data, $where);
        return $result->rowCount();
    }

    public function delete($where)
    {
        $result = self::$conn->delete(static::$table, $where);
        return $result->rowCount();
    }

    public function count($where = array())
    {
        return self::$conn->count(static::$table, $where);
    }

    public function query($query)
    {
        return self::$conn->query($query);
    }

    // public static function __callStatic($method, $parameters)
    // {
    //     var_dump($method, $parameters);
    //     // return (new static)->$method(...$parameters);
    // }
    // public static function __call($method, $parameters)
    // {
    //     var_dump("Call", $method, $parameters);
    // }
}
