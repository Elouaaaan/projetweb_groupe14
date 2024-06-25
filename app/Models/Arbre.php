<?php

namespace App\Models;

use Core\Database;

use PDO;


class Arbre
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $stmt = $this->db->query('SELECT * FROM arbre
            JOIN quartier USING(id_quartier)
            JOIN secteur USING(id_secteur)
            JOIN feuillage USING(id_feuillage)
            JOIN villeca USING(id_villeca)
            join nomtech USING(id_nomtech)
            JOIN situation USING(id_situation)
            JOIN pied USING(id_pied)
            JOIN port USING(id_port)
            JOIN stadedev USING(id_stadedev)
            JOIN arb_etat USING(id_arb_etat)
        ');
        return $stmt->fetchAll();
    }

    public function paginate($perPage, $page)
    {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->db->prepare('SELECT *  FROM arbre 
            JOIN quartier USING(id_quartier)
            JOIN secteur USING(id_secteur)
            JOIN feuillage USING(id_feuillage)
            JOIN villeca USING(id_villeca)
            JOIN nomtech USING(id_nomtech)
            JOIN situation USING(id_situation)
            JOIN pied USING(id_pied)
            JOIN port USING(id_port)
            JOIN stadedev USING(id_stadedev)
            JOIN arb_etat USING(id_arb_etat)
            LIMIT :offset, :perPage'
        );
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM arbre
            JOIN quartier USING(id_quartier)
            JOIN secteur USING(id_secteur)
            JOIN feuillage USING(id_feuillage)
            JOIN villeca USING(id_villeca)
            JOIN nomtech USING(id_nomtech)
            JOIN situation USING(id_situation)
            JOIN pied USING(id_pied)
            JOIN port USING(id_port)
            JOIN stadedev USING(id_stadedev)
            JOIN arb_etat USING(id_arb_etat)
            WHERE id = :id'
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}