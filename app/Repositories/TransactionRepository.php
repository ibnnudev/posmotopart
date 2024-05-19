<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\TransactionInterface;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class TransactionRepository implements TransactionInterface
{
    private $transaction;
    private $transactionDetail;
    private $cart;
    private $store;
    private $product;

    public function __construct(Transaction $transaction, TransactionDetail $transactionDetail, CartInterface $cart, ProductInterface $product)
    {
        $this->transaction       = $transaction;
        $this->transactionDetail = $transactionDetail;
        $this->cart              = $cart;
        $this->product           = $product;
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $carts           = $this->cart->getByUserId(auth()->user()->id);
            $transactionCode = 'TRX' . time();

            $carts->each->delete();
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function getAll()
    {
        return $this->transactionDetail->with(['transactions', 'paymentOption', 'destinationOrder'])->get();
    }

    public function getById($id)
    {
        return $this->transactionDetail->with(['transactions', 'paymentOption', 'destinationOrder'])->find($id);
    }

    public function groupByStore($transactionCode)
    {
        $data = $this->transaction->with('store', 'product')->where('transaction_code', $transactionCode)->get()->groupBy('store.name');
        return [
            'transactions' => $data,
            'customer'     => $this->transactionDetail->with('customer')->where('transaction_code', $transactionCode)->first()->customer,
            'transaction'  => $this->transactionDetail->where('transaction_code', $transactionCode)->first()
        ];
    }
}
