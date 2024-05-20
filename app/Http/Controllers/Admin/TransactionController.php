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
        $transactions = Auth::user()->hasRole('admin') ? $this->transaction->getAll() : $this->transaction->getAll()->where('store_id', auth()->user()->store->id);
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
        $transactions = $this->transaction->getByTransactionCode($transactionCode);                            // get list of transaction by transaction code
        $transaction  = $this->transaction->getTransactionDetailByTransactionCode($transactionCode)->first();
        $customer     = $transactions->first()->customer;
        return view('admin.transaction.show', [
            'transactions' => $transactions,
            'transaction'  => $transaction,
            'customer'     => $customer
        ]);
    }

    public function confirmOrder($id, Request $request)
    {
        try {
            $this->transaction->confirmOrder($id, $request->all());
            toast('Transaksi dikonfirmasi, menunggu buyer melakukan pembayaran', 'success');
            return redirect()->route('admin.transaction.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function changeStatus($id, Request $request)
    {
        try {
            $this->transaction->changeStatus($id, $request->all());
            return response()->json([
                'status' => true,
                'message' => 'Status transaksi berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function verificationPayment($id)
    {
        try {
            $this->transaction->verificationPayment($id);
            toast('Bukti pembayaran berhasil diveirifikasi', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function invoice($transactionCode, $type)
    {
        $transactions = $this->transaction->getByTransactionCode($transactionCode);
        $transactionsDetail = $this->transaction->getTransactionDetailByTransactionCode($transactionCode)->first();
        $pdf = app('dompdf.wrapper')->loadView('invoice', compact('transactions', 'transactionsDetail'));
        if ($type == 'stream') {
            return $pdf->stream('invoice.pdf');
        }
        if ($type == 'download') {
            return $pdf->download('invoice.pdf');
        }
        // return view('invoice', compact('transactions', 'transactionsDetail'));
    }
}
