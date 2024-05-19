<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Interfaces\CartInterface;
use App\Interfaces\PaymentOptionInterface;
use App\Interfaces\TransactionInterface;
use App\Services\DestinationOrderService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $cart;
    private $destinationOrder;
    private $paymentOption;
    private $transaction;

    public function __construct(CartInterface $cart, DestinationOrderService $destinationOrder, PaymentOptionInterface $paymentOption, TransactionInterface $transaction)
    {
        $this->cart             = $cart;
        $this->destinationOrder = $destinationOrder;
        $this->paymentOption    = $paymentOption;
        $this->transaction      = $transaction;
    }

    public function index()
    {
        $carts             = $this->cart->getByUserId(auth()->user()->id);
        $destinationOrders = $this->destinationOrder->getByUserId();
        $paymentOptions    = $this->paymentOption->getAll();
        return view('guest.checkout.index', compact('carts', 'destinationOrders', 'paymentOptions'));
    }

    public function addShipping(Request $request)
    {
        $this->destinationOrder->store($request->except('_token'));
        toast('Alamat pengiriman berhasil ditambahkan!', 'success');
        return redirect()->route('checkout.index');
    }

    public function store(Request $request)
    {
        try {
            $this->transaction->store($request->all());
            toast('Transaksi berhasil!', 'success');
            return redirect()->route('transaction.index');
        } catch (\Throwable $th) {
            throw $th;
            toast($th->getMessage(), 'error');
            return redirect()->route('checkout.index');
        }
    }
}
