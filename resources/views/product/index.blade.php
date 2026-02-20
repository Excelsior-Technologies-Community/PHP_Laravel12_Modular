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
            margin-bottom: 20px;
        }

        .header h1 {
            color: #333;
        }

        .add-btn {
            background: #11998e;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .add-btn:hover {
            background: #0b7d73;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #11998e;
            color: white;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
        }

        table tbody tr {
            border-bottom: 1px solid #ddd;
            transition: 0.3s;
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

        .footer {
            margin-top: 15px;
            text-align: center;
            color: #777;
            font-size: 13px;
        }

        .nav {
            margin-bottom: 15px;
        }

        .nav a {
            text-decoration: none;
            margin-right: 10px;
            color: #11998e;
            font-weight: bold;
        }

        .nav a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="nav">
            <a href="/users">Users</a> |
            <a href="/products">Products</a> |
            <a href="/auth/login">Logout</a>
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

            <tbody>

                @foreach($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product }}</td>
                        <td class="price">₹{{ ($index + 1) * 1000 }}</td>
                        <td><span class="status">Available</span></td>
                    </tr>
                @endforeach

            </tbody>

        </table>

        <div class="footer">
            Laravel 12 Modular Product Management
        </div>

    </div>

</body>

</html>