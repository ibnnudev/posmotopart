<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductCategoryInterface;
use App\Interfaces\StoreInterface;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $productCategory;
    private $store;

    public function __construct(ProductCategoryInterface $productCategory, StoreInterface $store)
    {
        $this->productCategory = $productCategory;
        $this->store = $store;
    }
}
