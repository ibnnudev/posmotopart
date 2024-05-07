<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function getAll();
    public function getBySKU($sku);
    public function create($data);
    public function import($data);
}
