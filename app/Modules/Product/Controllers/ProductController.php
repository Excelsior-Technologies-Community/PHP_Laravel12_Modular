<?php

namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('product.create');
    }

    // Store product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'status' => 'Available'
        ]);

        return redirect('/products')->with('success', 'Product added successfully');
    }

    // LIVE SEARCH
    public function search(Request $request)
    {
        $query = $request->get('query');

        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('price', 'like', "%{$query}%")
            ->get();

        return response()->json($products);
    }
}