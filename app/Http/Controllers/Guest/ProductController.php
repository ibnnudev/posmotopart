<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductCategoryInterface;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;
    private $productCategory;

    public function __construct(ProductInterface $product, ProductCategoryInterface $productCategory)
    {
        $this->product = $product;
        $this->productCategory = $productCategory;
    }

    public function index()
    {
        $categories = $this->productCategory->getAllStoreByCategory();
        return view('guest.product_category.index', compact('categories'));
    }

    public function show($categoryId, $storeId, Request $request)
    {
        $products = $this->product->getByCategoryAndStore($categoryId, $storeId);
        if ($request->wantsJson()) {
            return datatables()
                ->of($products)
                ->addColumn('sku', function ($data) {
                    return $data->SKU;
                })
                ->addColumn('merk', function ($data) {
                    return $data->merk ?? '-';
                })
                ->addColumn('machine_name', function ($data) {
                    return $data->machine_name ?? '-';
                })
                ->addColumn('SAE', function ($data) {
                    return $data->SAE ?? '-';
                })
                ->addColumn('type', function ($data) {
                    return $data->type ?? '-';
                })
                ->addColumn('size', function ($data) {
                    return $data->size ?? '-';
                })
                ->addColumn('price', function ($data) {
                    return 'Rp. ' . number_format($data->price, 0, ',', '.');
                })
                ->addColumn('discount', function ($data) {
                    return $data->discount . '%';
                })
                ->addColumn('final_price', function ($data) {
                    $price = $data->price - ($data->price * $data->discount / 100);
                    return 'Rp. ' . number_format($price, 0, ',', '.');
                })
                ->addColumn('stock', function ($data) {
                    return $data->stock;
                })
                ->addColumn('quantity', function ($data) {
                    return view('guest.product_category.quantity', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('guest.product_category.show', compact('products', 'categoryId', 'storeId'));
    }
}
