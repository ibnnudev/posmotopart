<?php

namespace App\Repositories;

use App\Interfaces\DiscountStoreInterface;
use App\Models\DiscountStore;

class DiscountStoreRepository implements DiscountStoreInterface
{
    private $discountStore;

    public function __construct(DiscountStore $discountStore)
    {
        $this->discountStore = $discountStore;
    }

    public function getAll()
    {
        return $this->discountStore->all();
    }

    public function getById($id)
    {
        return $this->discountStore->find($id);
    }

    public function store($discount_id, $store_id)
    {
        try {
            return $this->discountStore->create([
                'store_id' => $store_id,
                'discount_id' => $discount_id,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->discountStore->find($id);
            return $category->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function discountIsExist($discount_id, $store_id)
    {
        return $this->discountStore->where('discount_id', $discount_id)->where('store_id', $store_id)->where('deleted_at', null)->exists();
    }

    public function getByDiscountAndStore($discount_id, $store_id)
    {
        return $this->discountStore->where('discount_id', $discount_id)->where('store_id', $store_id)->where('deleted_at', null)->first();
    }

    public function getByDiscountId($discount_id)
    {
        return $this->discountStore->with('store.user')->where('discount_id', $discount_id)->where('deleted_at', null)->get();
    }
}
