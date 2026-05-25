<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product - Laravel Modular</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #11998e, #38ef7d);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 40%;
            margin: 80px auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            background: #11998e;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #0b7d73;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #11998e;
        }

        .delete-btn {
            background: #e74c3c;
            margin-top: 10px;
        }

        .delete-btn:hover {
            background: #c0392b;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>

</head>

<body>

<div class="container">

    <h2>Edit Product</h2>

    @if($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/products/{{ $product->id }}">
        @csrf
        @method('PUT')

        <label>Product Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" required>

        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>

        <label>Status</label>
        <select name="status">
            <option value="Available" {{ (old('status', $product->status) == 'Available') ? 'selected' : '' }}>Available</option>
            <option value="Out of Stock" {{ (old('status', $product->status) == 'Out of Stock') ? 'selected' : '' }}>Out of Stock</option>
        </select>

        <button type="submit">Update Product</button>
    </form>

    <form method="POST" action="/products/{{ $product->id }}" 
          onsubmit="return confirm('Are you sure you want to delete this product permanently?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-btn">Delete Product</button>
    </form>

    <a href="/products" class="back">← Back to Products</a>

</div>

</body>
</html>