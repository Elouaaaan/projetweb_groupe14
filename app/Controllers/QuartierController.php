<?php

namespace App\Controllers;

use App\Models\Categories\Quartier;

class QuartierController
{
    private $quartier;
    private $requestMethod;

    public function __construct($requestMethod)
    {
        $this->quartier = new Quartier();
        $this->requestMethod = $requestMethod;
    }

    public function processRequest($id_secteur = null)
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getQuartiers($id_secteur);
                break;
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getQuartiers($id_secteur)
    {
        if ($id_secteur) {
            $result = $this->quartier->findByIdSecteur($id_secteur);
        } else {
            $result = $this->quartier->all();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
}
