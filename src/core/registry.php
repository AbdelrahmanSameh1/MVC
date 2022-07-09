<?php

namespace itrax\core;


// this class enable us to treat with the database by (msqli or pdo)

class registry
{

    private static $object = [];


    public static function set($key, $value)
    {
        static::$object[$key] = $value;      // remember the difference between (self & static in this case) (late static bindings)
    }

    public static function get($key)
    {
        return static::$object[$key];
    }
}
