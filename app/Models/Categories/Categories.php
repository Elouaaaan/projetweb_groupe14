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

    public function all($fetch_num = true)
    {
        $stmt = $this->conn->query('SELECT * FROM ' . $this->table);
        return $stmt->fetchAll($fetch_num ? PDO::FETCH_NUM : '');
    }
}
