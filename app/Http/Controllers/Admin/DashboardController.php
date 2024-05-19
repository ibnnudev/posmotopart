<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\RequestProductInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\WalletInetrface;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private $user;
    private $requestProduct;
    private $wallet;
    private $transactionDetail;
    public function __construct(UserInterface $user, RequestProductInterface $requestProduct, WalletInetrface $wellet, TransactionDetail $transactionDetail)
    {
        $this->user = $user;
        $this->requestProduct = $requestProduct;
        $this->wallet = $wellet;
        $this->transactionDetail = $transactionDetail;
    }
    public function __invoke()
    {
        if (auth()->user()->hasRole('buyer')) {
            return redirect()->route('product-category.index');
        } else {
            return view('dashboard', [
                'totalUser' => $this->user->getAll()->count(),
                'totalRequestProduct' => $this->requestProduct->getAll()->count(),
                'totalRequestPaylater' => $this->wallet->getAll()->count(),
                'totalTransactionDetail' => $this->transactionDetail->where('status', $this->transactionDetail::PROCESS_BY_MERCHANT)->count(),

            ]);
        }
    }
}
