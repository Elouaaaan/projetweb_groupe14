<?php

namespace App\Controllers;

use App\Models\Arbre;

class ArbreController
{
    private $arbre;
    private $requestMethod;

    public function __construct($requestMethod)
    {
        $this->arbre = new Arbre();
        $this->requestMethod = $requestMethod;
    }

    public function processRequest($options)
    {
        switch ($this->requestMethod) {
            case 'GET':
                $column = $options['column'] ?? 'id_arbre';
                $reverse = filter_var($options['reverse'] ?? false, FILTER_VALIDATE_BOOLEAN);
                $per_page = $options['per_page'] ?? null;
                $page = $options['page'] ?? null;
                $search = $options['search'] ?? null;

                $response = $this->getArbres($column, $reverse, $per_page, $page, $search);
                break;
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getArbres($column, $reverse, $per_page = null, $page = null, $search = null)
    {
        $result = $this->arbre->all($column, $reverse, $per_page, $page, $search);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    public function addArbre()
    {
        $haut_tot = $_POST['haut_tot'] ?? null;
        $haut_tronc = $_POST['haut_tronc'] ?? null;
        $tronc_diam = $_POST['tronc_diam'] ?? null;
        $id_stadedev = $_POST['stade_dev'] ?? null;
        $id_nom_tech = $_POST['nom_tech'] ?? null;
        $longitude = $_POST['longitude'] ?? null;
        $latitude = $_POST['latitude'] ?? null;
        $revetement = $_POST['revetement'] ?? null;
        $nbr_diag = $_POST['nbr_diag'] ?? null;
        $remarquable = $_POST['remarquable'] ?? null;
        $id_secteur = $_POST['secteur'] ?? null;
        $id_quartier = $_POST['quartier'] ?? null;
        $id_arb_etat = $_POST['arb_etat'] ?? null;
        $id_port = $_POST['port'] ?? null;
        $id_pied = $_POST['pied'] ?? null;
        $id_situation = $_POST['situation'] ?? null;
        $id_villeca = $_POST['villeca'] ?? null;
        $id_feuillage = $_POST['feuillage'] ?? null;

        $result = $this->arbre->add($haut_tot, $haut_tronc, $tronc_diam, $id_stadedev, $id_nom_tech, $longitude, $latitude, $revetement, $nbr_diag, $remarquable, $id_secteur, $id_quartier, $id_arb_etat, $id_port, $id_pied, $id_situation, $id_villeca, $id_feuillage);
        return $result;
    }

    public function getClusters($cluster)
    {
        $result = $this->arbre->get_cluster_data();

        # get console output
        $json_data = tempnam(sys_get_temp_dir(), 'json_data');
        file_put_contents($json_data, json_encode($result, JSON_UNESCAPED_UNICODE));

        $output = shell_exec(__DIR__ . '/../../venv/bin/python3 ' . __DIR__ . '/../../python/cluster.py ' . $json_data . ' ' . $cluster);

        unlink($json_data);

        header('HTTP/1.1 200 OK');
        echo $output;
    }

    public function getUprooted($id_arbre)
    {
        $result = $this->arbre->get_arbre($id_arbre);

        $json_data = tempnam(sys_get_temp_dir(), 'json_data');
        file_put_contents($json_data, json_encode($result, JSON_UNESCAPED_UNICODE));

        $output = shell_exec(__DIR__ . '/../../venv/bin/python3 ' . __DIR__ . '/../../python/tempete.py ' . $json_data . ' 2>&1');

        unlink($json_data);

        return $output;
    }
}
