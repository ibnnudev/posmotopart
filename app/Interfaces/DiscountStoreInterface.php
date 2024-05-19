<?php

namespace App\Interfaces;

interface DiscountStoreInterface
{
    public function getAll();
    public function getById($id);
    public function store($store_id, $discount_id);
    public function destroy($id);
    public function discountIsExist($discount_id, $store_id);
    public function getByDiscountAndStore($discount_id, $store_id);
    public function getByDiscountId($discount_id);
}
