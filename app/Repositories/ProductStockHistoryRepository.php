<?php

namespace App\Repositories;

use App\Interfaces\ProductStockHistoryInterface;
use App\Models\Product;
use App\Models\ProductStockHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductStockHistoryRepository implements ProductStockHistoryInterface
{
    private $productStockHistory;
    private $product;

    public function __construct(ProductStockHistory $productStockHistory, Product $product)
    {
        $this->productStockHistory = $productStockHistory;
        $this->product = $product;
    }

    public function getByStore($id)
    {
        return $this->productStockHistory->with('product', 'store', 'createdBy')->where('store_id', $id)->get();
    }

    public function getAll()
    {
        return $this->productStockHistory->with('product', 'store', 'createdBy')->get();
    }

    public function create($data)
    {
        $product = $this->product->find($data['product_id']);
        $data['store_id'] = $product->store_id;
        $data['final_stock'] = $product->stock + $data['in_stock'] - $data['out_stock'];
        $data['created_by'] = auth()->user()->id;

        return $this->productStockHistory->create($data);
    }

    public function getByStoreAndProduct($store_id, $product_id)
    {
        return $this->productStockHistory->where('store_id', $store_id)->where('product_id', $product_id)->get();
    }

    public function import($file)
    {
        DB::beginTransaction();
        try {
            $fileContents = file($file->getPathname());
            unset($fileContents[0]);

            foreach ($fileContents as $row) {
                $column = explode(';', $row);
                if ($column == [''])   continue;
                $product = $this->product->where('SKU', $column[0])->first();
                $column[2] = preg_replace('/[^0-9]/', '', $column[2]);
                $this->productStockHistory->create([
                    'product_id' => $product->id,
                    'store_id'   => auth()->user()->store->id,
                    'in_stock'   => $column[1],
                    'out_stock'  => $column[2],
                    'final_stock' => $product->stock + $column[1] - $column[2],
                    'created_by' => auth()->user()->id,
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            throw $th;
        }
    }
}
