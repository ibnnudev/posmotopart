<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductCategoryInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\ProductMerkInterface;
use App\Interfaces\StoreInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;
    private $productCategory;
    private $productMerk;
    private $store;

    public function __construct(ProductInterface $product, ProductCategoryInterface $productCategory, ProductMerkInterface $productMerk, StoreInterface $store)
    {
        $this->product = $product;
        $this->productCategory = $productCategory;
        $this->productMerk = $productMerk;
        $this->store = $store;
    }

    public function index()
    {
        $categories = $this->productCategory->getAllStoreByCategory();
        return view('guest.product_category.index', compact('categories'));
    }

    public function show($categoryId, $storeId, Request $request)
    {
        $productMerks = $this->productMerk->getByStoreAndCategory($storeId, $categoryId);
        $store = $this->store->getById($storeId);
        return view('guest.product_category.show', compact('productMerks', 'store'));
    }
}
