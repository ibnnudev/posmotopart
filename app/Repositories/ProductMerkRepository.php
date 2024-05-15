<?php

namespace App\Repositories;

use App\Interfaces\ProductMerkInterface;
use App\Models\ProductMerk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductMerkRepository implements ProductMerkInterface
{
    private $productMerk;

    public function __construct(ProductMerk $productMerk)
    {
        $this->productMerk = $productMerk;
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

            $this->productMerk->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/product-merk/' . $filaname);
            throw $th;
            DB::rollBack();
        }
    }

    public function update($id, $data)
    {
        try {
            $productMerk = $this->productMerk->find($id);

            if ($data['image']) {
                Storage::delete('public/product-merk/' . $productMerk->image);
                $filaname = time() . '_' . $data['image']->getClientOriginalName();
                $data['image']->storeAs('public/product-merk', $filaname);
                $data['image'] = $filaname;
            }

            $productMerk->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/product-merk/' . $filaname);
            throw $th;
            DB::rollBack();
        }
    }

    public function destroy(string $id)
    {
        try {
            $productMerk = $this->productMerk->find($id);
            $productMerk->products()->update(['product_merk_id' => null]);
            Storage::delete('public/product-merk/' . $productMerk->image);
            $productMerk->delete();
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }
}
