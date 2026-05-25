<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Display list of products
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

    // Store new product
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

    // Show edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    // Update product
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

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect('/products')->with('success', 'Product deleted successfully!');
    }

    // Search products
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $products = Product::where('name', 'like', "%{$query}%")
                          ->orWhere('price', 'like', "%{$query}%")
                          ->get();
        
        return response()->json($products);
    }
}