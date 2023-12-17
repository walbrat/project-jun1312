<?php

namespace core;

class BaseModel
{
    protected \mysqli $db;

    protected bool $connectDb;

    public function __construct()
    {
        $db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        return $db;
    }
}