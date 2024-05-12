<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryInterface;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

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
        return $this->productCategory->where('is_active', 1)->get();
    }

    public function getById($id)
    {
        return $this->productCategory->find($id);
    }

    public function create($data)
    {
        $filename = uniqid() . '.' . $data['image']->getClientOriginalExtension();
        $data['image']->storeAs('public/product-category', $filename);
        $data['image'] = $filename;

        return $this->productCategory->create($data);
    }

    public function update($id, $data)
    {
        $productCategory = $this->productCategory->find($id);
        if (isset($data['image'])) {
            $filename = uniqid() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->storeAs('public/product-category', $filename);
            $data['image'] = $filename;

            Storage::delete('public/product-category/' . $productCategory->image);
        }

        return $productCategory->update($data);
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
