<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductCategoryInterface;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    private $productCategory;

    public function __construct(ProductCategoryInterface $productCategory)
    {
        $this->productCategory = $productCategory;
    }


    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return datatables()
                ->of($this->productCategory->getAll())
                ->addColumn('image', function ($data) {
                    return view('admin.product_category.partials._image', compact('data'));
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.product_category.partials._action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.product_category.index');
    }

    public function create()
    {
        return view('admin.product_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
        ]);

        try {
            $this->productCategory->create($request->all());
            toast('Kategori Produk berhasil ditambahkan', 'success');
            return redirect()->route('admin.product-category.index');
        } catch (\Throwable $th) {
            toast('Kategori Produk gagal ditambahkan', 'error');
            return redirect()->route('admin.product-category.index');
        }
    }

    public function edit($id)
    {
        $data = $this->productCategory->getById($id);
        return view('admin.product_category.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => 'required|string|max:255',
        ]);

        try {
            $this->productCategory->update($id, $request->all());
            toast('Kategori Produk berhasil diubah', 'success');
            return redirect()->route('admin.product-category.index');
        } catch (\Throwable $th) {
            toast('Kategori Produk gagal diubah', 'error');
            return redirect()->route('admin.product-category.index');
        }
    }

    public function destroy($id)
    {
        try {
            $this->productCategory->delete($id);
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }
    }
}
