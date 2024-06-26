<?php

namespace App\Models\Categories;

use App\Models\Categories\Categories;

class Quartier extends Categories
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'quartier';
    }

    public function getQuartierBySecteur($sector_id)
    {
        $stmt = $this->conn->prepare('SELECT id_quartier, quartier FROM quartier_secteur
            JOIN quartier USING(id_quartier)
            WHERE id_secteur = :id_secteur');
        $stmt->bindParam(':id_secteur', $sector_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}