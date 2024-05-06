<?php

namespace App\Repositories;

use App\Interfaces\PaymentOptionInterface;
use App\Models\PaymentOption;

class PaymentOptionRepository implements PaymentOptionInterface
{
    private $paymentOption;

    public function __construct(PaymentOption $paymentOption)
    {
        $this->paymentOption = $paymentOption;
    }

    public function getAll()
    {
        return $this->paymentOption->all();
    }

    public function getById($id)
    {
        return $this->paymentOption->find($id);
    }

    public function store($data)
    {
        try {
            return $this->paymentOption->create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($id, $data)
    {
        $category = $this->paymentOption->find($id);
        try {
            return $category->update($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->paymentOption->find($id);
            return $category->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
