<?php

namespace App\Models\Categories;

use PDO;
use Core\Database;

abstract class Categories
{
    protected $conn;
    protected $table;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $stmt = $this->conn->query('SELECT * FROM ' . $this->table);
        return $stmt->fetchAll(PDO::FETCH_NUM);
    }
}
