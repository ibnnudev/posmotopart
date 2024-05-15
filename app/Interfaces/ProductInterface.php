<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function getAll();
    public function getBySKU($sku);
    public function create($data);
    public function import($data);
    public function getById($id);
    public function getByStore($id);
    public function getByCategoryAndStore($categoryId, $storeId);
    public function getProductByMerk($productMerkId);
}
