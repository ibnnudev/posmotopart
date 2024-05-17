<?php

namespace App\Repositories;

use App\Interfaces\DiscountInterface;
use App\Models\Discount;
use Illuminate\Support\Facades\Storage;

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
            if (isset($data['logo'])) {
                $filename = uniqid() . '.' . $data['logo']->getClientOriginalExtension();
                $data['logo']->storeAs('public/discount', $filename);
                $data['logo'] = $filename;
            }
            return $this->discount->create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($id, $data)
    {
        $category = $this->discount->find($id);
        if (isset($data['logo'])) {

            if ($category->logo != null) {
                Storage::delete('public/discount/' . $category->logo);
            }

            $filename = uniqid() . '.' . $data['logo']->getClientOriginalExtension();
            $data['logo']->storeAs('public/discount', $filename);
            $data['logo'] = $filename;
        }
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

    public function getDiscountsNotExpired()
    {
        return $this->discount->where('is_active', true)->where('end_date', '>', now())->get();
    }
}
