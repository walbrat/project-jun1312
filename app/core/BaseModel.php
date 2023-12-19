<?php

namespace core;

class BaseModel
{
    protected \mysqli $db;

    protected bool $connectDb;

    public function __construct()
    {
        return new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
}