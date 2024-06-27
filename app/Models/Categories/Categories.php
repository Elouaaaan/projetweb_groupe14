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
        $stmt = $this->conn->query('SELECT * FROM ' . $this->table . ' ORDER BY ' . $this->table);
        return $stmt->fetchAll($fetch_num ? PDO::FETCH_NUM : PDO::FETCH_ASSOC);
    }

    public function idExist($id)
    {
        $stmt = $this->conn->prepare('SELECT COUNT(*) FROM ' . $this->table . ' WHERE id_' . $this->table . ' = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
