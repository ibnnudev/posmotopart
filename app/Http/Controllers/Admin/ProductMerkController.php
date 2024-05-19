<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ProductCategoryInterface;
use App\Interfaces\ProductMerkInterface;
use Illuminate\Http\Request;

class ProductMerkController extends Controller
{
    private $productMerk;
    private $productCategory;
    private $category;

    public function __construct(ProductMerkInterface $productMerk, ProductCategoryInterface $productCategory, CategoryInterface $category)
    {
        $this->productMerk     = $productMerk;
        $this->productCategory = $productCategory;
        $this->category        = $category;
    }

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return datatables()
                ->of($this->productMerk->getAll()->where('store_id', auth()->user()->store->id))
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('image', function ($data) {
                    return view('admin.product_merk.partial._image', compact('data'));
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
        $categories = $this->productCategory->getAll();
        return view('admin.product_merk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'               => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'                => 'required|string|max:255',
            'is_active'           => 'required|in:0,1',
            'product_category_id' => 'required|exists:product_categories,id'
        ]);

        try {
            $this->productMerk->store($request->except('_token'));
            toast('Data berhasil disimpan', 'success');
            return redirect()->route('admin.product-merk.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function edit(string $id)
    {
        $data = $this->productMerk->getById($id);
        $categories = $this->productCategory->getAll();
        return view('admin.product_merk.edit', compact('data', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'                => 'required|string|max:255',
            'is_active'           => 'required|in:0,1',
            'product_category_id' => 'required|exists:product_categories,id'
        ]);

        try {
            $this->productMerk->update($id, $request->except('_token', '_method'));
            toast('Data berhasil diubah', 'success');
            return redirect()->route('admin.product-merk.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->productMerk->destroy($id);
            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
}
