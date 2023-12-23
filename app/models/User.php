<?php

namespace models;

use core\BaseModel;
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
        if ($query->num_rows) {
            while ($result = $query->fetch_all(MYSQLI_ASSOC)) {
                $users[] = $result;
            }
        }
        return $users;
    }

    /**
     * @param int $id
     * @return array|false|null
     */
    public function getUserById(int $id) : array|false|null
    {
        $sql = "select * from users where id = $id;";
        $query = $this->db->query($sql);
        return $query->fetch_assoc();
        
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data) : bool
    {
        $login = $this->escape($data['login']);
        $email = $this->escape($data['email']);
        $password = $this->escape($data['password']);
        $sql = "insert into users (login, email, password) values ('$login', '$email', '$password')";
        return $this->db->query($sql);
    }
    
    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id) : bool
    {
        $sql = "delete from users where id = {$id}";
        return $this->db->query($sql);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data) : bool
    {
        $id = $this->escape($data['id']);
        $title = $this->escape($data['title']);
        $content = $this->escape($data['content']);
        $slug = $this->escape($data['slug']);
        $sql = "update pages SET title = '$title', content = '$content', slug = '$slug' where id = {$id}";
        return $this->db->query($sql);

    }
}