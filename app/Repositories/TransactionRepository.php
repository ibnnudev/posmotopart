<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\ProductStockHistoryInterface;
use App\Interfaces\StoreInterface;
use App\Interfaces\TransactionInterface;
use App\Models\PaymentOption;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransactionRepository implements TransactionInterface
{
    private $transaction;
    private $transactionDetail;
    private $cart;
    private $store;
    private $product;
    private $paymentOption;
    private $productStockHistory;

    public function __construct(Transaction $transaction, TransactionDetail $transactionDetail, CartInterface $cart, ProductInterface $product, StoreInterface $store, PaymentOption $paymentOption, ProductStockHistoryInterface $productStockHistory)
    {
        $this->transaction         = $transaction;
        $this->transactionDetail   = $transactionDetail;
        $this->cart                = $cart;
        $this->product             = $product;
        $this->store               = $store;
        $this->paymentOption       = $paymentOption;
        $this->productStockHistory = $productStockHistory;
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $carts       = $this->cart->getByUserId(auth()->user()->id);
            $groupedCart = $carts->groupBy('product.store_id');

            foreach ($groupedCart as $store_id => $cart) {
                $store           = $this->store->getById($store_id);
                $transactionCode = 'TRX' . time() . '-' . $store->id;
                $totalPrice      = $cart->sum('total_price');

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
        return $this->transactionDetail->with(['transactions', 'paymentOption', 'destinationOrder', 'store'])->orderBy('created_at', 'desc')->get();
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

    public function getTransactionDetailByTransactionCode($transactionCode)
    {
        return $this->transactionDetail->with('store', 'paymentOption', 'destinationOrder')->where('transaction_code', $transactionCode)->get();
    }

    public function confirmOrder($id, $data)
    {
        DB::beginTransaction();
        try {
            foreach ($data['rejected'] as $key => $value) {
                $transaction = $this->transaction->find($key);
                $transaction->update([
                    'rejected_qty' => $value,
                    'approved_qty' => $transaction->requested_qty - $value,
                    'total_price'  => $transaction->price * ($transaction->requested_qty - $value),
                ]);
            }

            $transactionDetail = $this->transactionDetail->find($id);

            $this->transactionDetail->find($id)->update([
                'qty'         => $this->transaction->where('transaction_code', $transactionDetail->transaction_code)->sum('approved_qty'),
                'total_price' => $this->transaction->where('transaction_code', $transactionDetail->transaction_code)->sum('total_price'),
                'admin_fee'   => $this->transaction->where('transaction_code', $transactionDetail->transaction_code)->sum('total_price') * 0.1,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function changeStatus($id, $data)
    {
        if ($data['status'] == 'admin_confirm') {
            $data['confirm_date'] = date('Y-m-d');
        }
        if ($data['status'] == 'shipping') {
            $data['shipping_date'] = date('Y-m-d');
        }
        return $this->transactionDetail->find($id)->update(['status' => $data['status']]);
    }

    public function uploadPaymentProof($id, $data)
    {
        DB::beginTransaction();
        try {
            $filename = uniqid() . '.' . $data['payment_proof']->getClientOriginalExtension();
            $data['payment_proof']->storeAs('public/payment-proof', $filename);
            $data['payment_proof'] = $filename;

            $this->transactionDetail->find($id)->update([
                'payment_proof' => $data['payment_proof'],
                'status'        => $this->transactionDetail::WAITING_CONFIRMATION
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/payment-proof/' . $filename);
            throw $th;
            DB::rollBack();
        }
    }

    public function verificationPayment($id)
    {
        DB::beginTransaction();
        try {
            $this->transactionDetail->find($id)->update(['status' => $this->transactionDetail::ADMIN_CONFIRM]);
            $transactions = $this->transaction->where('transaction_code', $this->transactionDetail->find($id)->transaction_code)->get();

            // create product stock history
            foreach ($transactions as $transaction) {
                $product = $this->product->getById($transaction->product_id);
                $this->productStockHistory->create([
                    'product_id'  => $product->id,
                    'store_id'    => $transaction->store_id,
                    'in_stock'    => 0,
                    'out_stock'   => $transaction->approved_qty == 0 ? $transaction->requested_qty : $transaction->approved_qty,
                    'final_stock' => $product->stock - $transaction->approved_qty,
                    'created_by'  => auth()->user()->id,
                ]);

                Product::find($product->id)->update(['stock' => $product->stock - $transaction->approved_qty]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function confirmPaylater($id)
    {
        DB::beginTransaction();
        try {
            $wallet = Wallet::where('user_id', auth()->user()->id)->first();
            if ($wallet->balance < $this->transactionDetail->find($id)->total_price) {
                throw new \Exception('Saldo tidak mencukupi');
                DB::rollBack();
            }
            $this->transactionDetail->find($id)->update(['status' => $this->transactionDetail::SHIPPING]);
            $transactions = $this->transaction->where('transaction_code', $this->transactionDetail->find($id)->transaction_code)->get();

            // create product stock history
            foreach ($transactions as $transaction) {
                $product = $this->product->getById($transaction->product_id);
                $this->productStockHistory->create([
                    'product_id'  => $product->id,
                    'store_id'    => $transaction->store_id,
                    'in_stock'    => 0,
                    'out_stock'   => $transaction->approved_qty == 0 ? $transaction->requested_qty : $transaction->approved_qty,
                    'final_stock' => $product->stock - $transaction->approved_qty,
                    'created_by'  => auth()->user()->id,
                ]);

                Product::find($product->id)->update(['stock' => $product->stock - $transaction->approved_qty]);
            }
            $wallet->update(['balance' => $wallet->balance - $this->transactionDetail->find($id)->total_price]);

            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function confirmReceive($id, $data)
    {
        DB::beginTransaction();
        try {
            $filename = uniqid() . '.' . $data['receipt_proof']->getClientOriginalExtension();
            $data['receipt_proof']->storeAs('public/receipt-proof', $filename);
            $data['receipt_proof'] = $filename;

            $this->transactionDetail->find($id)->update([
                'receive_proof' => $data['receipt_proof'],
                'receive_date'  => date('Y-m-d'),
                'receive_by'    => auth()->user()->id,
                'status'        => $this->transactionDetail::DONE
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/receipt-proof/' . $filename);
            throw $th;
            DB::rollBack();
        }
    }
}
