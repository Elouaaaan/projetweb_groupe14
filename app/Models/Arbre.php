<?php

namespace App\Models;

use Core\Database;

use App\Models\Categories\Quartier;
use App\Models\Categories\Secteur;
use App\Models\Categories\Nomtech;
use App\Models\Categories\Situation;
use App\Models\Categories\Pied;
use App\Models\Categories\Port;
use App\Models\Categories\Stadedev;
use App\Models\Categories\ArbEtat;
use App\Models\Categories\Villeca;
use App\Models\Categories\Feuillage;

use PDO;


class Arbre
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all($column = 'id_arbre', $reverse = false, $per_page = null, $page = null, $search = null)
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
                                      nomtech LIKE :word' . $index . ' OR 
                                      pied LIKE :word' . $index . ' OR 
                                      port LIKE :word' . $index . ' OR 
                                      quartier LIKE :word' . $index . ' OR 
                                      secteur LIKE :word' . $index . ' OR 
                                      situation LIKE :word' . $index . ' OR 
                                      stadedev LIKE :word' . $index . ' OR 
                                      villeca LIKE :word' . $index . ')';
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
        $data = $stmt->fetchAll();

        foreach ($data as &$row) {
            $row['revetement'] = $row['revetement'] ? 'Oui' : 'Non';
            $row['remarquable'] = $row['remarquable'] ? 'Oui' : 'Non';
        }

        return $data;
    }

    public function add($haut_tot, $haut_tronc, $tronc_diam, $id_stadedev, $id_nom_tech, $longitude, $latitude, $revetement, $nbr_diag, $remarquable, $id_secteur, $id_quartier, $id_arb_etat, $id_port, $id_pied, $id_situation, $id_villeca, $id_feuillage)
    {

        if (!$haut_tot || !$haut_tronc || !$tronc_diam || !(new Stadedev())->idExist($id_stadedev) || !(new Nomtech())->idExist($id_nom_tech)) {
            return [
                'status_code_header' => 'HTTP/1.1 422 Unprocessable Entity',
                'body' => json_encode(['error' => 'Missing required fields'])
            ];
        }

        $longitude = $longitude === null ? '' : $longitude;
        $latitude = $latitude === null ? '' : $latitude;
        $revetement = $revetement === null ? '' : $revetement;
        $nbr_diag = $nbr_diag === null ? '' : $nbr_diag;
        $remarquable = $remarquable === null ? '' : $remarquable;
        $id_secteur = $id_secteur === null ? '' : $id_secteur;
        $id_quartier = $id_quartier === null ? '' : $id_quartier;
        $id_arb_etat = $id_arb_etat === null ? '' : $id_arb_etat;
        $id_port = $id_port === null ? '' : $id_port;
        $id_pied = $id_pied === null ? '' : $id_pied;
        $id_situation = $id_situation === null ? '' : $id_situation;
        $id_villeca = $id_villeca === null ? '' : $id_villeca;
        $id_feuillage = $id_feuillage === null ? '' : $id_feuillage;

        $id_secteur = (new Secteur())->idExist($id_secteur) ? $id_secteur : NULL;
        $id_quartier = (new Quartier())->idExist($id_quartier) ? $id_quartier : NULL;
        $id_arb_etat = (new ArbEtat())->idExist($id_arb_etat) ? $id_arb_etat : NULL;
        $id_port = (new Port())->idExist($id_port) ? $id_port : NULL;
        $id_pied = (new Pied())->idExist($id_pied) ? $id_pied : NULL;
        $id_situation = (new Situation())->idExist($id_situation) ? $id_situation : NULL;
        $id_villeca = (new Villeca())->idExist($id_villeca) ? $id_villeca : NULL;
        $id_feuillage = (new Feuillage())->idExist($id_feuillage) ? $id_feuillage : NULL;

        $query = 'INSERT INTO arbre (haut_tot, haut_tronc, tronc_diam, id_stadedev, id_nomtech, longitude, latitude, revetement, nbr_diag, remarquable, id_secteur, id_quartier, id_arb_etat, id_port, id_pied, id_situation, id_villeca, id_feuillage) VALUES (:haut_tot, :haut_tronc, :tronc_diam, :id_stadedev, :id_nomtech, :longitude, :latitude, :revetement, :nbr_diag, :remarquable, :id_secteur, :id_quartier, :id_arb_etat, :id_port, :id_pied, :id_situation, :id_villeca, :id_feuillage)';

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':haut_tot', $haut_tot, PDO::PARAM_INT);
        $stmt->bindValue(':haut_tronc', $haut_tronc, PDO::PARAM_INT);
        $stmt->bindValue(':tronc_diam', $tronc_diam, PDO::PARAM_INT);
        $stmt->bindValue(':id_stadedev', $id_stadedev, PDO::PARAM_INT);
        $stmt->bindValue(':id_nomtech', $id_nom_tech, PDO::PARAM_INT);
        $stmt->bindValue(':longitude', $longitude, PDO::PARAM_INT);
        $stmt->bindValue(':latitude', $latitude, PDO::PARAM_INT);
        $stmt->bindValue(':revetement', $revetement, PDO::PARAM_BOOL);
        $stmt->bindValue(':nbr_diag', $nbr_diag, PDO::PARAM_INT);
        $stmt->bindValue(':remarquable', $remarquable, PDO::PARAM_BOOL);
        $stmt->bindValue(':id_secteur', $id_secteur, PDO::PARAM_INT);
        $stmt->bindValue(':id_quartier', $id_quartier, PDO::PARAM_INT);
        $stmt->bindValue(':id_arb_etat', $id_arb_etat, PDO::PARAM_INT);
        $stmt->bindValue(':id_port', $id_port, PDO::PARAM_INT);
        $stmt->bindValue(':id_pied', $id_pied, PDO::PARAM_INT);
        $stmt->bindValue(':id_situation', $id_situation, PDO::PARAM_INT);
        $stmt->bindValue(':id_villeca', $id_villeca, PDO::PARAM_INT);
        $stmt->bindValue(':id_feuillage', $id_feuillage, PDO::PARAM_INT);

        $stmt->execute();

        return [
            'status_code_header' => 'HTTP/1.1 201 Created',
            'body' => null
        ];
    }

    public function get_cluster_data()
    {
        $query = 'SELECT longitude, latitude, haut_tot, tronc_diam, port FROM arbre
        JOIN port USING(id_port)';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }
}
