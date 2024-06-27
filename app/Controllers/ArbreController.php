<?php

namespace App\Controllers;

use App\Models\Arbre;

class ArbreController
{
    private $arbre;
    private $requestMethod;
    private $options;


    public function __construct($requestMethod)
    {
        $this->arbre = new Arbre();
        $this->requestMethod = $requestMethod;
    }

    public function processRequest($options)
    {
        $response = null;
        switch ($this->requestMethod) {
            case 'GET':
                $column = $options['column'] ?? 'id_arbre';
                $reverse = $options['reverse'] ?? false;
                $per_page = $options['per_page'] ?? null;
                $page = $options['page'] ?? null;
                $search = $options['search'] ?? null;

                $response = $this->getArbres($column, $reverse, $per_page, $page, $search);
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
}
