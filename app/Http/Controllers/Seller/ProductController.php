<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use App\Interfaces\ProductStockHistoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;
    private $productStock;

    public function __construct(ProductInterface $product, ProductStockHistoryInterface $productStock)
    {
        $this->product = $product;
        $this->productStock = $productStock;
    }

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return datatables()
                ->of($this->product->getByStore(auth()->user()->store->id))
                ->addColumn('sku', function ($data) {
                    return view('admin.product.patials._sku', ['data' => $data]);
                })
                ->addColumn('sku_seller', function ($data) {
                    return $data->SKU_seller == '' || $data->SKU_seller == null ? '-' : $data->SKU_seller;
                })
                ->addColumn('category', function ($data) {
                    return $data->productCategory->name;
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('stock', function ($data) {
                    return $data->stock;
                })
                ->addColumn('price', function ($data) {
                    return 'Rp ' . number_format($data->price, 0, ',', '.');
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.product.index');
    }

    public function import(Request $request)
    {
        // read csv file
        $file         = $request->file('file');
        $fileContents = file($file->getPathname());

        // remove header
        unset($fileContents[0]);

        $store_id = auth()->user()->store->id;
        // insert to database
        $batchInsert = [];
        foreach ($fileContents as $row) {
            $data = explode(',', $row);
            $this->product->create([
                'id'         => (string) \Illuminate\Support\Str::uuid(),
                'user_id'    => auth()->id(),
                'store_id'   => $store_id,
                'SKU'        => trim($data[0], '"'),
                'SKU_seller' => $data[1] == '' || $data[1] == '""' ? null : trim($data[1], '"'),
                'name'       => trim($data[2], '"'),
                'stock'      => (int) $data[3] ?? 0,
                'price'      => (float)  str_replace("\n", "", $data[4]),
                'unit'       => preg_match('/\((.*?)\)/', $data[2], $matches) ? strtoupper($matches[1]) : 'PCS',
                'size'         => $this->extractSize($data[2]),
                'type'         => $this->extractType($data[2]),
                'machine_name' => '-',
                'SAE'          => '-',
                'manufacturer' => '-',
                'merk'         => null // TODO: change to dynamic soon
            ]);
        }

        toast('Data berhasil diimport', 'success');
        return redirect()->route('admin.product.index');
    }

    private function extractSize($data)
    {
        $words = explode(' ', $data);
        if (strtolower($words[1]) == 'ban') {
            return $words[3];
        } else {
            $rest = explode(' ', implode(' ', array_slice($words, 3)));
            if (count($rest) > 3) {
                return $rest[2] . $rest[3];
            } else {
                return $rest[1];
            }
        }
    }

    private function extractType($data)
    {
        // if word contain OLI return '-'
        if (strpos($data, 'OLI') !== false) {
            return '-';
        }

        // get word after size 
        $words = explode(' ', $data);
        $size  = $this->extractSize($data);
        $index = array_search($size, $words);
        $type  = $words[$index + 1];

        return $type;
    }

    public function show($id)
    {
        $data = $this->product->getById($id);
        $productStock = $this->productStock->getByStoreAndProduct(auth()->user()->store->id, $id);
        return view('admin.product.show', compact('data', 'productStock'));
    }
}
