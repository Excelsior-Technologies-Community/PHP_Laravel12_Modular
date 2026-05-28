<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products - Laravel Modular</title>
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
            width: 90%;
            margin: 50px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-btn {
            background: #11998e;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-btn:hover {
            background: #0b7d73;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table thead {
            background: #11998e;
            color: white;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table tbody tr:hover {
            background: #f0fffc;
        }

        .price {
            color: #11998e;
            font-weight: bold;
        }

        .status {
            background: #38a169;
            color: white;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            display: inline-block;
        }

        .status.out-of-stock {
            background: #e74c3c;
        }

        .controls {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .controls input {
            flex: 1;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .controls select {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
            min-width: 200px;
        }

        .no-data {
            text-align: center;
            color: #e74c3c;
            padding: 20px;
        }

        .edit-btn {
            background: #3498db;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            margin-right: 5px;
            font-size: 12px;
        }

        .edit-btn:hover {
            background: #2980b9;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
        }

        .delete-btn:hover {
            background: #c0392b;
        }

        .success-msg {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
    </style>

</head>

<body>

<div class="container">

    <div class="header">
        <h1>Product List</h1>
        <a href="/products/create" class="add-btn">+ Add Product</a>
    </div>

    @if(session('success'))
        <div class="success-msg">
            {{ session('success') }}
        </div>
    @endif

    <div class="controls">
        <input type="text" id="search" placeholder="Search product by name or price...">
        <select id="sort">
            <option value="">Default Sorting</option>
            <option value="newest">Newest First</option>
            <option value="oldest">Oldest First</option>
            <option value="price_asc">Price: Low to High</option>
            <option value="price_desc">Price: High to Low</option>
        </select>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="productTable">
            @if($products->count() > 0)
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="price">₹{{ number_format($product->price, 2) }}</td>
                    <td>
                        <span class="status {{ $product->status == 'Out of Stock' ? 'out-of-stock' : '' }}">
                            {{ $product->status }}
                        </span>
                    </td>
                    <td>
                        <a href="/products/{{ $product->id }}/edit" class="edit-btn">Edit</a>
                        
                        <form method="POST" action="/products/{{ $product->id }}" style="display: inline;" 
                              onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="no-data">No Products Found</td>
                </tr>
            @endif
        </tbody>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    function fetchProducts() {
        let query = $('#search').val();
        let sort = $('#sort').val();
        
        $.ajax({
            url: "/products/search",
            type: "GET",
            data: { query: query, sort: sort },
            success: function (data) {
                let rows = "";
                
                if (data.length > 0) {
                    $.each(data, function (key, product) {
                        let statusClass = product.status == 'Out of Stock' ? 'out-of-stock' : '';
                        rows += `
                            <tr>
                                <td>${product.id}</td>
                                <td>${product.name}</td>
                                <td class="price">₹${parseFloat(product.price).toFixed(2)}</td>
                                <td><span class="status ${statusClass}">${product.status}</span></td>
                                <td>
                                    <a href="/products/${product.id}/edit" class="edit-btn">Edit</a>
                                    <form method="POST" action="/products/${product.id}" style="display: inline;" 
                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    rows = `<tr><td colspan="5" class="no-data">No Products Found</td></tr>`;
                }
                
                $('#productTable').html(rows);
            }
        });
    }

    $('#search').on('keyup', fetchProducts);
    $('#sort').on('change', fetchProducts);
});
</script>

</body>
</html>