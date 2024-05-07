<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Interfaces\RequestProductInterface;
use App\Models\RequestProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RequestProductRepository implements RequestProductInterface
{
    private $requestProduct;
    private $product;

    public function __construct(RequestProduct $requestProduct, ProductInterface $product)
    {
        $this->requestProduct = $requestProduct;
        $this->product        = $product;
    }

    public function getAll()
    {
        return $this->requestProduct->with('store', 'user')->get();
    }

    public function getByStore($store_id)
    {
        return $this->requestProduct->where('store_id', $store_id)->with('store', 'user')->get();
    }

    public function getById($id)
    {
        return $this->requestProduct->with('store', 'user')->find($id);
    }

    public function changeStatus($id, $data)
    {
        DB::beginTransaction();
        try {
            $imported = $this->getById($id);
            if ($data['status'] == 'diterima') {
                $file         = $imported['file'];
                $fileContents = explode("\n", Storage::get('public/request_product/' . $file));

                unset($fileContents[0]);

                foreach ($fileContents as $row) {
                    $column = explode(';', $row);
                    if ($column == [''])   continue;
                    $this->product->create([
                        'id'           => (string) \Illuminate\Support\Str::uuid(),
                        'user_id'      => $imported['user_id'],
                        'store_id'     => $imported['store_id'],
                        'SKU'          => trim($column[0], '"'),
                        'SKU_seller'   => $column[1] ?? '-',
                        'name'         => trim($column[2], '"'),
                        'stock'        => (int) $column[7] ?? 0,
                        'price'        => (float)  $column[10],
                        'unit'         => $column[9],
                        'size'         => $column[8] ?? null,
                        'type'         => $column[3],
                        'machine_name' => $column[4],
                        'SAE'          => $column[5],
                        'manufacturer' => $column[6],
                        'discount'     => str_replace('\r', '', $column[11]),
                        'merk'         => null                         // TODO: change to dynamic soon
                    ]);
                }
            }

            $data['reviewed_by'] = auth()->user()->id;
            $imported->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function addEntry($data)
    {
        $data['user_id']  = auth()->user()->id;
        $data['store_id'] = auth()->user()->store->id;
        return $this->requestProduct->create($data);
    }

    public function import($data)
    {
        DB::beginTransaction();
        try {
            $filename = 'PR-' . date('YmdHis') . '.' . $data['file']->getClientOriginalExtension();
            $data['file']->storeAs('public/request_product', $filename);
            $this->requestProduct->create([
                'user_id'  => auth()->user()->id,
                'store_id' => auth()->user()->store->id,
                'file'     => $filename,
                'status'   => 'menunggu',
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/request_product/' . $filename);
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
}
