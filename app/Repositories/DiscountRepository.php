<?php

namespace App\Repositories;

use App\Interfaces\DiscountInterface;
use App\Models\Discount;

class DiscountRepository implements DiscountInterface
{
    private $discount;

    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    public function getAll()
    {
        return $this->discount->all();
    }

    public function getById($id)
    {
        return $this->discount->find($id);
    }

    public function store($data)
    {
        try {
            return $this->discount->create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($id, $data)
    {
        $category = $this->discount->find($id);
        try {
            return $category->update($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->discount->find($id);
            return $category->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
