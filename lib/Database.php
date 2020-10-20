<?php

class Database {
    /**
     * @var string $host
     */
    protected $host = 'localhost:8889';

    /**
     * @var string $dbname
     */
    protected $dbname = 'notes';

    /**
     * @var string $user
     */
    protected $user = 'root';

    /**
     * @var string $password
     */
    protected $password = 'root';

    /**
     * @var PDO $link
     */
    protected $link;

    /**
     * @return PDO
     */
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