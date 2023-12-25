<?php

namespace models;

use core\BaseModel;

class Auth extends BaseModel
{

    /**
     * @return array
     */
    public function all(): array
    {

        $sql = "SELECT * FROM users;";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @param $login
     * @param $password
     * @param $email
     * @return void
     */
    public function addUser($login, $password, $email): void
    {
        $sql = "insert into users (login, password, email)
                            values ('{$login}', '{$password}', '{$email}')";
        $this->db->query($sql);
    }

    /**
     * @param $login
     * @return array|false|null
     */
    public function getUserByLogin($login): false|array|null
    {
        $sql = "SELECT * FROM `users` WHERE login = '{$login}'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
}