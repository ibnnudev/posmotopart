<?php

namespace App\Repositories;

use App\Interfaces\StoreInterface;
use App\Models\ProductCategory;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreRepository implements StoreInterface
{
    private $store;
    private $user;
    private $productCategory;

    public function __construct(Store $store, User $user, ProductCategory $productCategory)
    {
        $this->store = $store;
        $this->user = $user;
        $this->productCategory = $productCategory;
    }

    public function getAll()
    {
        return $this->store->with('user')->get();
    }

    public function getById($id)
    {
        return $this->store->with('user')->find($id);
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $user = $this->user->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('seller');

            if (isset($data['logo']) && $data['logo'] != null) {
                $filename = Str::random(10) . '.' . $data['logo']->getClientOriginalExtension();
                $data['logo']->storeAs('public/store', $filename);
                $data['logo'] = $filename;
            }

            $data['name'] = $data['store_name'];
            $data['slug'] = Str::slug($data['store_name']);
            $data['user_id'] = $user->id;

            $this->store->create($data);

            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/store/' . $filename);
            throw $th;
            DB::rollBack();
        }
    }

    public function update($id, $data)
    {
        DB::beginTransaction();
        try {
            $store = $this->store->find($id);

            $this->user->find($store->user_id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            if (isset($data['logo']) && $data['logo'] != null) {
                Storage::delete('public/store/' . $store->logo);
                $filename = Str::random(10) . '.' . $data['logo']->getClientOriginalExtension();
                $data['logo']->storeAs('public/store', $filename);
                $data['logo'] = $filename;
            }

            $data['name'] = $data['store_name'];
            $data['slug'] = Str::slug($data['store_name']);

            $store->update($data);
        } catch (\Throwable $th) {
            Storage::delete('public/store/' . $filename);
            DB::rollBack();
            throw $th;
        }
        DB::commit();
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->user->find($this->store->find($id)->user_id)->delete();
            $this->store->find($id)->update(['status' => 0]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            throw $th;
        }

        DB::commit();
    }

    public function updateStatus($id, $status)
    {
        DB::beginTransaction();
        try {
            $store = $this->getById($id);
            if ($status == 'true') {
                $this->user->withTrashed()->find($store->user_id)->restore();
                $store->update(['status' => 1]);
            } else {
                $this->user->find($store->user_id)->delete();
                $store->update(['status' => 0]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function updateStoreOnly($id, $data)
    {
        DB::beginTransaction();
        try {
            $store = $this->store->find($id);

            if (isset($data['logo']) && $data['logo'] != null) {
                Storage::delete('public/store/' . $store->logo);
                $filename = Str::random(10) . '.' . $data['logo']->getClientOriginalExtension();
                $data['logo']->storeAs('public/store', $filename);
                $data['logo'] = $filename;
            }

            $data['slug'] = Str::slug($data['name']);

            $store->update($data);

            $this->user->find($store->user_id)->update([
                'bank_name' => $data['bank_name'],
                'card_number' => $data['card_number'],
                'owner_name' => $data['owner_name']
            ]);
        } catch (\Throwable $th) {
            Storage::delete('public/store/' . $filename);
            DB::rollBack();
            throw $th;
        }
        DB::commit();
    }

    public function updateBank($id, $data)
    {
        DB::beginTransaction();
        try {
            $store = $this->store->find($id);
            $store->update($data);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        DB::commit();
    }

    public function getBySlug($slug)
    {
        $productCategory = $this->productCategory->whereHas('products', function ($query) use ($slug) {
            $query->where('store_id', $this->store->where('slug', $slug)->first()->id);
        })->with('products')->get();

        dd($productCategory);
    }
}
