<?php

namespace App\Views;

class Form {
    private $form = '';

    public function __construct($action = '#', $method = 'post') {
        $this->form = '<form action="' . $action . '" method="' . $method . '" class="tree-form">';
    }

    public function addRow($row) {
        $this->form .= $row->getRow();
    }

    public function getForm() {
        return $this->form . '</form>';
    }
}
