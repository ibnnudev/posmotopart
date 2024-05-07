<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
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

    public function getById($id)
    {
        return $this->product->find($id);
    }
}
