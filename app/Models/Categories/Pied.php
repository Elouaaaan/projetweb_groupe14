<?php

namespace App\Models\Categories;

use App\Models\Categories\Categories;

class Pied extends Categories
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'pied';
    }
}