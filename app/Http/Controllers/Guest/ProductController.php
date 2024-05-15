<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Interfaces\CartInterface;
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
    private $cart;

    public function __construct(ProductInterface $product, ProductCategoryInterface $productCategory, ProductMerkInterface $productMerk, StoreInterface $store, CartInterface $cart)
    {
        $this->product = $product;
        $this->productCategory = $productCategory;
        $this->productMerk = $productMerk;
        $this->store = $store;
        $this->cart = $cart;
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

    public function products($product_merk_id)
    {
        $products = $this->product->getProductByMerk($product_merk_id);
        $productMerk = $this->productMerk->getById($product_merk_id);
        $store = $this->store->getById($productMerk->store_id);
        return view('guest.product_category.products', compact('products', 'store', 'productMerk'));
    }
}
