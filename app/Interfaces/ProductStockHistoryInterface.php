<?php

namespace App\Interfaces;

interface ProductStockHistoryInterface
{
    public function getByStore($id);
    public function getAll();
    public function create($data);
    public function getByStoreAndProduct($store_id, $product_id);
    public function import($file);
}
