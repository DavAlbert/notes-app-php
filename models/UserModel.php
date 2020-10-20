<?php

namespace Models;

use Database;
use PDO;

class UserModel {
    /**
     * @var Database $db
     */
    protected $db;

    /**
     * UserModel constructor.
     *
     * @param Database $database
     */
    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return bool
     */
    public function changePassword($username, $password)
    {
        $link = $this->db->open();
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $handle = $link->prepare('UPDATE users SET password = ? WHERE username = ?');
        $handle->bindValue(1, $hashedPassword);
        $handle->bindValue(2, $username);
        $result = $handle->execute();
        $this->db->close();
        return $result;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return bool
     */
    public function login($username, $password)
    {
        $link = $this->db->open();
        $handle = $link->prepare('SELECT * FROM users WHERE username = ?');
        $handle->bindValue(1, $username);
        $handle->execute();
        $hashedPassword = $handle->fetch(PDO::FETCH_OBJ)->password;
        $this->db->close();
        return password_verify($password, $hashedPassword);
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return bool
     */
    public function register($username, $password)
    {
        $link = $this->db->open();
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $handle = $link->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $handle->bindValue(1, $username);
        $handle->bindValue(2, $hashedPassword);
        $result = $handle->execute();
        $this->db->close();
        return $result;
    }

    /**
     * @param string $username
     *
     * @return integer
     */
    public function getId($username)
    {
        $link = $this->db->open();
        $handle = $link->prepare('SELECT * FROM users WHERE username = ?');
        $handle->bindValue(1, $username);
        $handle->execute();
        $result = $handle->fetch(PDO::FETCH_OBJ)->id;
        $this->db->close();
        return $result;
    }
}