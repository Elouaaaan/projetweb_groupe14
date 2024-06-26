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

    public function all($column, $reverse, $per_page = null, $page = null, $search = null)
    {
        $query = 'SELECT age_estim, arb_etat, feuillage, haut_tot, haut_tronc, id_arbre, latitude, longitude, nbr_diag, nomtech, pied, port, prec_estim, quartier, remarquable, revetement, secteur, situation, stadedev, tronc_diam, villeca FROM arbre
            JOIN quartier USING(id_quartier)
            JOIN secteur USING(id_secteur)
            JOIN feuillage USING(id_feuillage)
            JOIN villeca USING(id_villeca)
            JOIN nomtech USING(id_nomtech)
            JOIN situation USING(id_situation)
            JOIN pied USING(id_pied)
            JOIN port USING(id_port)
            JOIN stadedev USING(id_stadedev)
            JOIN arb_etat USING(id_arb_etat)';

        if ($search) {
            $searchWords = str_getcsv($search, ' ', '"');
            $searchConditions = [];

            foreach ($searchWords as $index => $word) {
                $searchConditions[] = '(' . 
                                      'age_estim LIKE :word' . $index . ' OR 
                                      arb_etat LIKE :word' . $index . ' OR 
                                      feuillage LIKE :word' . $index . ' OR 
                                      haut_tot LIKE :word' . $index . ' OR 
                                      haut_tronc LIKE :word' . $index . ' OR 
                                      latitude LIKE :word' . $index . ' OR 
                                      longitude LIKE :word' . $index . ' OR 
                                      nbr_diag LIKE :word' . $index . ' OR 
                                      nomtech LIKE :word' . $index . ' OR 
                                      pied LIKE :word' . $index . ' OR 
                                      port LIKE :word' . $index . ' OR 
                                      prec_estim LIKE :word' . $index . ' OR 
                                      quartier LIKE :word' . $index . ' OR 
                                      remarquable LIKE :word' . $index . ' OR 
                                      revetement LIKE :word' . $index . ' OR 
                                      secteur LIKE :word' . $index . ' OR 
                                      situation LIKE :word' . $index . ' OR 
                                      stadedev LIKE :word' . $index . ' OR 
                                      tronc_diam LIKE :word' . $index . ' OR 
                                      villeca LIKE :word' . $index . ')' ;
            }
            $query .= ' WHERE ' . implode(' AND ', $searchConditions);
        }

        $query .= ' ORDER BY ' . $column . ' ' . ($reverse ? 'DESC' : 'ASC');

        if ($per_page && $page) {
            $offset = ($page - 1) * $per_page;
            $query .= ' LIMIT :offset, :per_page';
        }

        $stmt = $this->db->prepare($query);

        if ($search) {
            foreach ($searchWords as $index => $word) {
                $stmt->bindValue(':word' . $index, '%' . $word . '%', PDO::PARAM_STR);
            }
        }

        if ($per_page && $page) {
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }
}