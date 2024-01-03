<?php

namespace models;

use core\BaseModel;
use helpers\Session;
use \mysqli;

class User extends BaseModel
{
    /**
     * @return array
     */
    public function getUsers() : array
    {
        $users = [];
        $sql = "select * from users;";
        $query = $this->db->query($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @param int $id
     * @return array|false|null
     */
    public function getUserById(int $id)
    {
        $sql = "select * from users where id = '$id' ;";
        $query = $this->db->query($sql);
        return $query->fetch_assoc();
    }

    /**
     * @param string $login
     * @return array|false|null
     */
    public function getUserByLogin(string $login)
    {
        $sql = "select * from users where login = '$login' ;";
        $query = $this->db->query($sql);
        return $query->fetch_assoc();
    }

    /**
     * @param string $email
     * @return array|false|null
     */
    public function getUserByEmail(string $email)
    {
        $sql = "select * from users where email = '$email' ;";
        $query = $this->db->query($sql);
        return $query->fetch_assoc();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data) : bool    {

        $login = $this->escape($data['login']);
        $email = $this->escape($data['email']);
        $password = $this->escape($data['password']);
        $sql = "insert into users (login, email, password) values ('$login', '$email', '$password')";
        return $this->db->query($sql);
    }

    /**
     * @param $data
     * @return bool|false
     */
    public function destroy($data) : bool
    {
        if (!Session::isAuthRoot() && $data['id'] == 1) {
            return false;
        }
        $sql = "delete from users where id = '".$data['id']."'";
        return $this->db->query($sql);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data) : bool
    {
        if (!Session::isAuthRoot() && $data['id'] == 1) {
            return false;
        }
        $id = $this->escape($data['id']);
        $login = $this->escape($data['login']);
        $email = $this->escape($data['email']);
        $sql = "update users SET login = '$login', email = '$email' where id = '$id'";
        return $this->db->query($sql);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function updatePassword(array $data) : bool
    {
        if (!Session::isAuthRoot() && $data['id'] == 1) {
            return false;
        }
        $id = $this->escape($data['id']);
        $password = $data['password'];
        $sql = "update users SET password = '$password' where id = '$id'";
        return $this->db->query($sql);
    }
}