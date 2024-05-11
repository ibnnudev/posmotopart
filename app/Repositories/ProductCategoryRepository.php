<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryInterface;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductCategoryRepository implements ProductCategoryInterface
{
    private $productCategory;
    private $product;

    public function __construct()
    {
        $this->productCategory = new ProductCategory();
        $this->product = new Product();
    }

    public function getAll()
    {
        return $this->productCategory->all();
    }

    public function getById($id)
    {
        return $this->productCategory->find($id);
    }

    public function create($data)
    {
        return $this->productCategory->create($data);
    }

    public function update($id, $data)
    {
        return $this->productCategory->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->productCategory->find($id)->update(['is_active' => 0]);
    }

    public function getByStore($storeId)
    {
        $productIds = $this->product->where('store_id', $storeId)->pluck('product_category_id');
        return $this->productCategory->whereIn('id', $productIds)->get();
    }
}
