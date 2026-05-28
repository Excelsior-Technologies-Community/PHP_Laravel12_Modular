<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('product.index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->filled('query')) {
            $searchTerm = $request->input('query');
            $query->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('price', 'like', "%{$searchTerm}%");
        }

        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            if ($sort == 'newest') {
                $query->latest();
            } elseif ($sort == 'oldest') {
                $query->oldest();
            } elseif ($sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        } else {
            $query->latest();
        }

        $products = $query->get();

        return response()->json($products);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string'
        ]);

        Product::create($request->all());

        return redirect('/products')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect('/products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return back()->with('success', 'Product deleted successfully!');
    }
}