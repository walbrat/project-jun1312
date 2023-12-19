<?php

namespace core;

use mysqli;

class BaseModel
{
    protected mysqli $db;

    protected bool $connectDb;
    
    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
}