<?php

namespace App\Models\Categories;

use App\Models\Categories\Categories;

class Nomtech extends Categories
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'nomtech';
    }
}