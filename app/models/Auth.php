<?php

namespace models;

use core\BaseModel;

class Auth extends BaseModel
{

    public function all()
    {

        $sql = "SELECT * FROM users;";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addUser($login, $password, $email)
    {
        var_dump($login, $password, $email);
        $sql = "insert into users (login, password, email)
                            values ('{$login}', '{$password}', '{$email}')";
        $this->db->query($sql);
    }

    public function getUserByLogin($login)
    {
        $sql = "SELECT * FROM `users` WHERE login = '$login';";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
}