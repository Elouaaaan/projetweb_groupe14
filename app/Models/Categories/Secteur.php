<?php

namespace App\Models\Categories;

use App\Models\Categories\Categories;

class Secteur extends Categories
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'secteur';
    }

    public function findByIdQuartier($quartier_id)
    {
        $stmt = $this->conn->prepare('SELECT id_secteur, secteur FROM quartier_secteur
            JOIN secteur USING(id_secteur)
            ');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
