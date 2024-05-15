<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductStockHistory;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface
{
    private $product;
    private $productStockHistory;
    private $cart;

    public function __construct(Product $product, ProductStockHistory $productStockHistory, Cart $cart)
    {
        $this->product = $product;
        $this->productStockHistory = $productStockHistory;
        $this->cart = $cart;
    }

    public function getAll()
    {
        return $this->product->all();
    }

    public function getBySKU($sku)
    {
        return $this->product->where('SKU', $sku)->first();
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $product = $this->product->create($data);
            DB::commit();
            return $product;
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            throw $e;
        }
    }

    public function import($data)
    {
    }

    public function getByStore($id)
    {
        return $this->product->where('store_id', $id)->get();
    }

    public function getById($id)
    {
        return $this->product->find($id);
    }

    public function getByCategoryAndStore($categoryId, $storeId)
    {
        $products = $this->product->where('product_category_id', $categoryId)->where('store_id', $storeId)->get();
        // add final stock from product stock history
        foreach ($products as $product) {
            $productStockHistory = $this->productStockHistory->where('product_id', $product->id)->orderBy('id', 'desc')->first();
            $product->final_stock = $productStockHistory->final_stock;
        }
        return $products;
    }

    public function getProductByMerk($productMerkId)
    {
        $products = $this->product->where('product_merk_id', $productMerkId)->get()->groupBy('unit');
        foreach ($products as $unit => $product) {
            $product->map(function ($item) {
                $cart = $this->cart->where('product_id', $item->id)->where('user_id', auth()->user()->id)->first();
                $item->cart = $cart;
                return $item ?? null;
            });
        }
        return $products;
    }
}
