<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Interfaces\TransactionInterface;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transaction;

    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index()
    {
        $transactionDetails = $this->transaction->getAll()->where('user_id', auth()->user()->id)->sortByDesc('updated_at');
        foreach ($transactionDetails as $transactionDetail) {
            $transactionDetail->transactions = Transaction::where('transaction_code', $transactionDetail->transaction_code)->get();
        }
        return view('guest.transaction.index', compact('transactionDetails'));
    }

    public function uploadPaymentProof($id, Request $request)
    {
        try {
            $this->transaction->uploadPaymentProof($id, $request->all());
            toast('Bukti pembayaran berhasil diunggah', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function confirmReceive($id, Request $request)
    {
        try {
            $this->transaction->confirmReceive($id, $request->all());
            toast('Barang berhasil diterima', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function cancelOrder($id, Request $request)
    {
        try {
            $request['status'] = 'user_reject';
            $this->transaction->changeStatus($id, $request->all());
            toast('Pesanan berhasil dibatalkan', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }
}
