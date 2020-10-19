<?php namespace Models;
class NoticeModel {
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function create($userId, $text)
    {
        $link = $this->db->open();
        $handle = $link->prepare('INSERT INTO notices (text, user_id) VALUES (?, ?)');
        $handle->bindValue(1, $text);
        $handle->bindValue(2, $userId);
        $result = $handle->execute();
        $this->db->close();
        return $result;
    }

    public function delete($userId, $id)
    {
        $link = $this->db->open();
        $handle = $link->prepare('DELETE FROM notices WHERE id = ? AND user_id = ?');
        $handle->bindValue(1, $id);
        $handle->bindValue(2, $userId);
        $result = $handle->execute();
        $this->db->close();
        return $result;
    }

    public function showAll($userId) {
        $link = $this->db->open();
        $handle = $link->prepare('SELECT * FROM notices WHERE user_id = ?');
        $handle->bindValue(1, $userId);
        $result = false;
        if ($handle->execute()) {
            $result = $handle->fetchAll();
        }
        $this->db->close();
        return $result;
    }
}