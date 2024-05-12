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
        $categories = $this->productCategory->getAll();
        return view('guest.product_category.index', compact('categories'));
    }
}
