<?php
class Database {
    protected $host = 'localhost:8889';
    protected $dbname = 'notes';
    protected $user = 'root';
    protected $password = 'root';

    protected $link = null;

    public function open()
    {
        $this->link = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
        return $this->link;
    }

    public function close()
    {
        $this->link = null;
    }
}