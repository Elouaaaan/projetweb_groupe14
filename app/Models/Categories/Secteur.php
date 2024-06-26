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
            WHERE id_quartier = :id_quartier');
        $stmt->bindParam(':id_quartier', $quartier_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
