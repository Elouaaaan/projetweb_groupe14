<?php

namespace App\Models\Categories;

use PDO;
use Core\Database;

abstract class Categories
{
    private $db;
    protected $table;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $stmt = $this->db->query('SELECT * FROM ' . $this->table);
        return $stmt->fetchAll(PDO::FETCH_NUM);
    }
}
