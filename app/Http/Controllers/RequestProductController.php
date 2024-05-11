<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductCategoryInterface;
use App\Interfaces\RequestProductInterface;
use App\Models\RequestProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RequestProductController extends Controller
{
    private $requestProduct;
    private $productCategory;

    public function __construct(RequestProductInterface $requestProduct, ProductCategoryInterface $productCategory)
    {
        $this->requestProduct = $requestProduct;
        $this->productCategory = $productCategory;
    }


    public function index(Request $request)
    {
        $result = auth()->user()->roles->pluck('name')->toArray()[0] == 'seller' ? $this->requestProduct->getByStore(auth()->user()->store->id) : $this->requestProduct->getAll();
        if ($request->wantsJson()) {
            return datatables($result)
                ->addColumn('file', function ($data) {
                    return view('admin.request_product.partials._file', compact('data'));
                })
                ->addColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->locale('id')->isoFormat('D MMMM Y HH:mm');
                })
                ->addColumn('product_category', function ($data) {
                    return $data->productCategory->name ?? '-';
                })
                ->addColumn('status', function ($data) {
                    return view('admin.request_product.partials._status', compact('data'));
                })
                ->addColumn('feedback', function ($data) {
                    return $data->feedback ?? '-';
                })
                ->addColumn('reviewer', function ($data) {
                    return $data->reviewedBy->name ?? '-';
                })
                // check if user is admin
                ->addColumn('action', function ($data) {
                    return $data->status == 'menunggu' ? view('admin.request_product.partials._action', compact('data')) : '-';
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.request_product.index');
    }

    public function import(Request $request)
    {
        try {
            $this->requestProduct->import($request->all());
            toast('Data berhasil diimport', 'success');
            return redirect()->route('admin.request-product.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.request-product.index');
        }
    }

    public function create()
    {
        $productCategories = $this->productCategory->getAll()->where('is_active', 1);
        return view('admin.request_product.create', [
            'productCategories' => $productCategories
        ]);
    }

    public function changeStatusForm($id)
    {
        $data = $this->requestProduct->getById($id);
        return view('admin.request_product.change_status', compact('data'));
    }

    public function edit($id)
    {
        $data = $this->requestProduct->getById($id);
        $productCategories = $this->productCategory->getAll()->where('is_active', 1);
        return view('admin.request_product.edit', compact('data', 'productCategories'));
    }

    public function changeStatus($id, Request $request)
    {
        try {
            $this->requestProduct->changeStatus($id, $request->all());
            toast('Status berhasil diubah', 'success');
            return redirect()->route('admin.request-product.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.request-product.edit', $id);
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'product_category_id' => 'required',
            'file' => 'nullable|mimes:csv',
        ]);
        try {
            $this->requestProduct->update($id, $request->all());
            toast('Data berhasil diubah', 'success');
            return redirect()->route('admin.request-product.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.request-product.edit', $id);
        }
    }
}
