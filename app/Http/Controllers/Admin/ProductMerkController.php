<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductMerkInterface;
use Illuminate\Http\Request;

class ProductMerkController extends Controller
{
    private $productMerk;

    public function __construct(ProductMerkInterface $productMerk)
    {
        $this->productMerk = $productMerk;
    }

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return datatables()
                ->of($this->productMerk->getAll())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('image', function ($data) {
                    return view('admin.product_merk.partial._image', compact('data'))->render();
                })
                ->addColumn('product_category', function ($data) {
                    return $data->productCategory->name;
                })
                ->addColumn('is_active', function ($data) {
                    return $data->is_active ? 'Aktif' : 'Tidak Aktif';
                })
                ->addColumn('action', function ($data) {
                    return view('admin.product_merk.partial._action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.product_merk.index');
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
