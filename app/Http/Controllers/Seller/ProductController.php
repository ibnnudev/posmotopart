<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;


    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }


    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return datatables()
                ->of($this->product->getAll())
                ->addColumn('sku', function ($data) {
                    return $data->SKU;
                })
                ->addColumn('sku_seller', function ($data) {
                    return $data->SKU_seller ?? '-';
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
                // ->addColumn('action', function ($data) {
                //     return view('admin.product.patials._action', ['data' => $data]);
                // })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.product.index');
    }

    public function import(Request $request)
    {
        // read csv file
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        // remove header
        unset($fileContents[0]);

        $store_id = auth()->user()->store->id;
        // insert to database
        $batchInsert = [];
        foreach ($fileContents as $row) {
            $data = explode(',', $row);
            $this->product->create([
                'id' => (string) \Illuminate\Support\Str::uuid(),
                'user_id' => auth()->id(),
                'store_id' => $store_id,
                'SKU' => trim($data[0], '"'),
                'SKU_seller' => $data[1],
                'name' => trim($data[2], '"'),
                'stock' => $data[3],
                'price' => (float)  str_replace("\n", "", $data[4]),
                'unit' => preg_match('/\((.*?)\)/', $data[2], $matches) ? strtoupper($matches[1]) : 'PCS',
                'size' => $this->extractSize($data[2]),
                'type' => $this->extractType($data[2]),
                'machine_name' => '-',
                'SAE' => '-',
                'manufacturer' => '-',
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
        $size = $this->extractSize($data);
        $index = array_search($size, $words);
        $type = $words[$index + 1];

        return $type;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}