<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\TransactionInterface;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private $transaction;

    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index(Request $request)
    {
        $transactions = Auth::user()->hasRole('admin') ? $this->transaction->getAll() : $this->transaction->getAll()->where('status', TransactionDetail::PROCESS_BY_MERCHANT)->where('store_id', auth()->user()->store->id);
        if ($request->wantsJson()) {
            return datatables()
                ->of($transactions)
                ->addColumn('code', function ($data) {
                    return $data->transaction_code;
                })
                ->addColumn('store', function ($data) {
                    return $data->store->name;
                })
                ->addColumn('created_at', function ($data) {
                    return date('d/m/Y', strtotime($data->created_at));
                })
                ->addColumn('customer', function ($data) {
                    return $data->customer->name;
                })
                ->addColumn('payment_option', function ($data) {
                    return $data->paymentOption->name;
                })
                ->addColumn('status', function ($data) {
                    return view('admin.transaction.status', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.transaction.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.transaction.index');
    }

    public function show($transactionCode)
    {
        $transactions = $this->transaction->getByTransactionCode($transactionCode); // get list of transaction by transaction code
        dd($transactions->first());
        $customer = $transactions->first()->customer;
        return view('admin.transaction.show', [
            'transactions' => $transactions,
            'customer' => $customer
        ]);
    }

    public function changeStatus($id, Request $request)
    {
        try {
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
