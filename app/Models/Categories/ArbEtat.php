<?php

namespace App\Models\Categories;

use App\Models\Categories\Categories;

class ArbEtat extends Categories
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'arb_etat';
    }
}
