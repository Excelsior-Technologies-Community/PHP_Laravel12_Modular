<?php

namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = ['TV', 'Mobile', 'Laptop'];
        return view('product.index', compact('products'));
    }
}