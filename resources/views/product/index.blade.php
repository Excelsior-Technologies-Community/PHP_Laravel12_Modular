<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products - Laravel Modular</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #11998e, #38ef7d);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 85%;
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
        }

        .add-btn {
            background: #11998e;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
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
        }

        .search-box input {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .no-data {
            text-align: center;
            color: red;
            padding: 20px;
        }
    </style>

</head>

<body>

<div class="container">

    <div class="header">
        <h1>Product List</h1>
        <a href="/products/create" class="add-btn">+ Add Product</a>
    </div>

    <div class="search-box">
        <input type="text" id="search" placeholder="Search product by name or price...">
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody id="productTable">

            @if($products->count() > 0)

                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td class="price">₹{{ $product->price }}</td>
                        <td>
                            <span class="status">{{ $product->status }}</span>
                        </td>
                    </tr>
                @endforeach

            @else
                <tr>
                    <td colspan="4" class="no-data">No Products Found</td>
                </tr>
            @endif

        </tbody>
    </table>

</div>

<!-- AJAX LIVE SEARCH -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $('#search').on('keyup', function () {

        let query = $(this).val();

        $.ajax({
            url: "/products/search",
            type: "GET",
            data: { query: query },
            success: function (data) {

                let rows = "";

                if (data.length > 0) {

                    data.forEach(function (product) {
                        rows += `
                            <tr>
                                <td>${product.id}</td>
                                <td>${product.name}</td>
                                <td class="price">₹${product.price}</td>
                                <td><span class="status">${product.status ?? 'Available'}</span></td>
                            </tr>
                        `;
                    });

                } else {
                    rows = `
                        <tr>
                            <td colspan="4" class="no-data">No Products Found</td>
                        </tr>
                    `;
                }

                $('#productTable').html(rows);
            }
        });

    });

});
</script>

</body>
</html>