<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\StoreInterface;
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

    public function __construct(Transaction $transaction, TransactionDetail $transactionDetail, CartInterface $cart, ProductInterface $product, StoreInterface $store)
    {
        $this->transaction       = $transaction;
        $this->transactionDetail = $transactionDetail;
        $this->cart              = $cart;
        $this->product           = $product;
        $this->store             = $store;
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $carts           = $this->cart->getByUserId(auth()->user()->id);
            $groupedCart     = $carts->groupBy('product.store_id');

            foreach ($groupedCart as $store_id => $cart) {
                $store      = $this->store->getById($store_id);
                $transactionCode = 'TRX' . time() . '-' . $store->id;
                $totalPrice = $cart->sum('total_price');

                // add transaction
                foreach ($cart as $item) {
                    $transaction = $this->transaction->create([
                        'transaction_code' => $transactionCode,
                        'user_id'          => auth()->user()->id,
                        'store_id'         => $store->id,
                        'product_id'       => $item->product_id,
                        'requested_qty'    => $item->qty,
                        'price'            => $item->price,
                        'discount_price'   => isset($item->discount_price) ? $item->discount_price : 0,
                        'total_price'      => $item->total_price,
                        'status'           => 'pending',
                    ]);
                }

                // add transaction detail
                $this->transactionDetail->create([
                    'transaction_code'     => $transactionCode,
                    'transaction_id'       => $transaction->id,
                    'user_id'              => auth()->user()->id,
                    'store_id'             => $store->id,
                    'qty'                  => $cart->sum('qty'),
                    'total_price'          => $cart->sum('total_price'),
                    'admin_fee'            => $cart->sum('total_price') * 0.1,
                    'status'               => $this->transactionDetail::PROCESS_BY_MERCHANT,
                    'payment_option_id'    => $data['payment_option_id'],
                    'destination_order_id' => $data['address_id']
                ]);
            }

            $carts->each->delete();
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function getAll()
    {
        return $this->transactionDetail->with(['transactions', 'paymentOption', 'destinationOrder', 'store'])->get();
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

    public function getByTransactionCode($transactionCode)
    {
        return $this->transaction->with('store', 'product', 'customer')->where('transaction_code', $transactionCode)->get();
    }
}
