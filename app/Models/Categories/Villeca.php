<?php

namespace App\Models\Categories;

use App\Models\Categories\Categories;

class Villeca extends Categories
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'villeca';
    }
}