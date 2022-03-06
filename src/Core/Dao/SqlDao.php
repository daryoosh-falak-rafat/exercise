<?php
namespace Exercise\Core\Dao;

abstract class SqlDao {

    protected \mysqli $db;

    public function __construct() {
        $this->db = new \mysqli('db', 'root', 'example', 'exercise', 3306);
    }
}