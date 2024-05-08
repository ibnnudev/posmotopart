<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductInterface;
use App\Interfaces\ProductStockHistoryInterface;
use App\Models\ProductStockHistory;
use Illuminate\Http\Request;

class ProductStockHistoryController extends Controller
{
    private $productStockHistory;
    private $product;

    public function __construct(ProductStockHistoryInterface $productStockHistory, ProductInterface $product)
    {
        $this->productStockHistory = $productStockHistory;
        $this->product = $product;
    }

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return datatables()
                ->of($this->productStockHistory->getByStore(auth()->user()->store->id))
                ->addColumn('created_by', function ($data) {
                    return $data->createdBy->name ?? '-';
                })
                ->addColumn('sku', function ($data) {
                    return $data->product->SKU ?? '-';
                })
                ->addColumn('product_name', function ($data) {
                    return $data->product->SKU_seller ?? '-';
                })
                ->addColumn('name', function ($data) {
                    return $data->product->name ?? '-';
                })
                ->addColumn('in_stock', function ($data) {
                    return $data->in_stock ?? '-';
                })
                ->addColumn('stock_out', function ($data) {
                    return $data->out_stock ?? '-';
                })
                ->addColumn('final_stock', function ($data) {
                    return $data->final_stock ?? '-';
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y H:i:s') ?? '-';
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.product_stock_history.index');
    }

    public function create()
    {
        $products = $this->product->getByStore(auth()->user()->store->id);
        return view('admin.product_stock_history.create', [
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'in_stock'   => 'required',
            'out_stock'  => 'required',
        ]);

        try {
            $this->productStockHistory->create($request->except('_token'));
            toast('Data berhasil disimpan', 'success');
            return redirect()->route('admin.product-stock-history.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.product-stock-history.create');
        }
    }

    public function downloadTemplate()
    {
        $results = $this->productStockHistory->getByStore(auth()->user()->store->id);
        $filename = 'product_stock_history_' . time() . '.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, [
            'SKU',
            'Qty Masuk',
            'Qty Keluar',
        ]);

        foreach ($results as $row) {
            fputcsv($handle, [
                $row->product->SKU,
                $row->in_stock,
                $row->out_stock,
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function import(Request $request)
    {
        try {
            $this->productStockHistory->import($request->file('file'));
            toast('Data berhasil diimport', 'success');
            return redirect()->route('admin.product-stock-history.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.product-stock-history.index');
        }
    }
}
