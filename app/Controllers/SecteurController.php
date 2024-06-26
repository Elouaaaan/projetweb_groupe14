<?php

namespace App\Controllers;

use App\Models\Categories\Secteur;

class SecteurController
{
    private $secteur;
    private $requestMethod;

    public function __construct($requestMethod)
    {
        $this->secteur = new Secteur();
        $this->requestMethod = $requestMethod;
    }

    public function processRequest($id_quartier = null)
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getSecteurs($id_quartier);
                break;
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getSecteurs($id_quartier)
    {
        if ($id_quartier) {
            $result = $this->secteur->findByIdQuartier($id_quartier);
        } else {
            $result = $this->secteur->all();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
}
