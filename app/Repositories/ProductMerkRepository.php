<?php

namespace App\Repositories;

use App\Interfaces\ProductMerkInterface;
use App\Models\Product;
use App\Models\ProductMerk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductMerkRepository implements ProductMerkInterface
{
    private $productMerk;
    private $product;

    public function __construct(ProductMerk $productMerk, Product $product)
    {
        $this->productMerk = $productMerk;
        $this->product = $product;
    }

    public function getAll()
    {
        return $this->productMerk->all();
    }

    public function getById(string $id)
    {
        return $this->productMerk->find($id);
    }

    public function store($data)
    {
        try {
            if ($data['image']) {
                $filaname = time() . '_' . $data['image']->getClientOriginalName();
                $data['image']->storeAs('public/product-merk', $filaname);
                $data['image'] = $filaname;
            }
            $data['store_id'] = auth()->user()->store->id;

            $this->productMerk->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            Storage::delete('public/product-merk/' . $filaname);
            throw $th;
            DB::rollBack();
        }
    }

    public function update($id, $data)
    {
        try {
            $productMerk = $this->productMerk->find($id);

            if (isset($data['image'])) {
                Storage::delete('public/product-merk/' . $productMerk->image);
                $filename = time() . '_' . $data['image']->getClientOriginalName();
                $data['image']->storeAs('public/product-merk', $filename);
                $data['image'] = $filename;
            }

            $productMerk->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/product-merk/' . $filename);
            throw $th;
            DB::rollBack();
        }
    }

    public function destroy(string $id)
    {
        try {
            $productMerk = $this->productMerk->find($id);
            Storage::delete('public/product-merk/' . $productMerk->image);
            $products = $this->product->where('product_merk_id', $id)->get();
            if ($products->count() > 0) {
                $products->each(function ($product) {
                    $product->update(['product_merk_id' => null]);
                });
            }
            $productMerk->delete();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            throw $th;
            DB::rollBack();
        }
    }

    public function getByStore($storeid)
    {
        return $this->productMerk->where('store_id', $storeid)->get();
    }

    public function getByStoreAndCategory($storeid, $categoryId)
    {
        return $this->productMerk->where('store_id', $storeid)->where('product_category_id', $categoryId)->get();
    }
}
