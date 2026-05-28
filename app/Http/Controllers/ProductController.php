<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Out of Stock'
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status
        ]);
        
        return redirect('/products')->with('success', 'Product added successfully!');
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
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Out of Stock'
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status
        ]);
        
        return redirect('/products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect('/products')->with('success', 'Product deleted successfully!');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->get('query');
        $sort = $request->get('sort');
        
        $query = Product::query();
        
        if (!empty($searchTerm)) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('price', 'like', "%{$searchTerm}%");
            });
        }
        
        if (!empty($sort)) {
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
}