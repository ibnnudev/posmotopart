<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use App\Interfaces\RequestProductInterface;
use App\Interfaces\TransactionInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\WalletInetrface;
use App\Models\RequestProduct;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private $transaction;
    private $transactionDetail;
    private $product;
    private $requestProduct;
    public function __construct(TransactionDetail $transactionDetail, TransactionInterface $transaction, ProductInterface $product, RequestProductInterface $requestProduct)
    {

        $this->transaction = $transaction;
        $this->transactionDetail = $transactionDetail;
        $this->product = $product;
        $this->requestProduct = $requestProduct;
    }
    public function __invoke()
    {
        if (auth()->user()->hasRole('buyer')) {
            return redirect()->route('product-category.index');
        } else {
            $data = $this->getDataPerMonth();

            return view('dashboard', [
                'totalTransactionDetail' =>   number_format($this->transactionDetail->where('status', $this->transactionDetail::DONE)->sum('total_price'), 2, ',', '.'),
                'jumlahTransactionDetail' =>  $this->transactionDetail->where('status', $this->transactionDetail::PROCESS_BY_MERCHANT)->count(),
                'totalRejectTransaction' =>  $this->transaction->getAll()->where('status', 'user_reject')->count('id'),
                'jumlahSkuNull' => $this->product->getAll()->where('stock', null)->count(),
                'jumlahBarangDitolak' => $this->transaction->getAll()->where('status', TransactionDetail::ADMIN_REJECT)
                    ->where('status', TransactionDetail::USER_REJECT)->count(),
                'data' => $data,
            ]);
        }
    }
    protected function getDataPerMonth()
    {
        $startYear = date('Y') - 5; // Tahun 5 tahun sebelumnya
        $endYear = date('Y'); // Tahun saat ini

        $labels = [];
        $organicData = [];
        $socialMediaData = [];

        // Loop through each year
        for ($year = $startYear; $year <= $endYear; $year++) {
            for ($month = 1; $month <= 12; $month++) {
                $totalOrganic = TransactionDetail::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->where('status', $this->transactionDetail::PROCESS_BY_MERCHANT)
                    ->sum('total_price');
                $totalSocialMedia = TransactionDetail::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->where('status', $this->transactionDetail::DONE)
                    ->sum('total_price');
                $labels[] = Carbon::createFromDate($year, $month, 1)->format('M Y');
                $organicData[] = ['x' => Carbon::createFromDate($year, $month, 1)->format('M Y'), 'y' => $totalOrganic];
                $socialMediaData[] = ['x' => Carbon::createFromDate($year, $month, 1)->format('M Y'), 'y' => $totalSocialMedia];
            }
        }

        return [
            'colors' => ["#1A56DB", "#FDBA8C"],
            'series' => [
                [
                    'name' => 'Organic',
                    'color' => "#1A56DB",
                    'data' => $organicData
                ],
                [
                    'name' => 'Social media',
                    'color' => "#FDBA8C",
                    'data' => $socialMediaData
                ]
            ]
        ];
    }
}
