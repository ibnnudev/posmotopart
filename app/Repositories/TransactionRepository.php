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
            $carts = $this->cart->getByUserId(auth()->user()->id);

            // add to transaction
            foreach ($carts as $cart) {
                $transaction = $this->transaction->create([
                    'user_id'       => auth()->user()->id,
                    'store_id'      => $this->product->getById($cart->product_id)->store_id,
                    'product_id'    => $cart->product_id,
                    'requested_qty' => $cart->qty,
                    'price'         => $cart->price,
                    'total_price'   => $cart->total_price,
                    'status'        => 'pending', // waiting for seller approval the stock
                ]);
            }

            $this->transactionDetail->create([
                'transaction_id'       => $transaction->id,
                'user_id'              => auth()->user()->id,
                'qty'                  => $carts->sum('qty'),
                'total_price'          => $carts->sum('total_price'),
                'admin_fee'            => $carts->sum('total_price') * 0.1,
                'status'               => $this->transactionDetail::PROCESS_BY_MERCHANT,
                'payment_option_id'    => $data['payment_option_id'],
                'destination_order_id' => $data['address_id']
            ]);

            $carts->each->delete();

            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }
}
