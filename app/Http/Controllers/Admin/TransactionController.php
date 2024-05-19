<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\TransactionInterface;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transaction;

    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    public function processByMerchant(Request $request)
    {
        if ($request->wantsJson()) {
            return datatables()
                ->of($this->transaction->getAll()->where('status', TransactionDetail::PROCESS_BY_MERCHANT))
                ->addColumn('code', function ($data) {
                    return $data->transaction_code;
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

        return view('admin.transaction.process_by_merchant');
    }

    public function show($transactionCode)
    {
        $data = $this->transaction->groupByStore($transactionCode);
        return view('admin.transaction.show', [
            'transactions' => $data['transactions'],
            'customer'     => $data['customer'],
            'transaction'  => $data['transaction']
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
