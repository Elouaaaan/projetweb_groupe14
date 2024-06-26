<?php

namespace App\Controllers;

use App\Models\Arbre;

class ArbreController
{
    public function __construct($requestMethod, $options)
    {
        $this->arbre = new Arbre();
        $this->requestMethod = $requestMethod;
        $this->options = $options;
    }

    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                $column = $this->options['column'] ?? 'id_arbre';
                $reverse = $this->options['reverse'] ?? false;
                $per_page = $this->options['per_page'] ?? null;
                $page = $this->options['page'] ?? null;
                $search = $this->options['search'] ?? null;

                $response = $this->getArbres($column, $reverse, $per_page, $page, $search);
            }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getArbres($column, $reverse, $per_page = null, $page = null, $search = null) {
        $result = $this->arbre->all($column, $reverse, $per_page, $page, $search);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

}