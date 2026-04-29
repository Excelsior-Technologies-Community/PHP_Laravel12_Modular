<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Product - Laravel Modular</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    </style>

</head>

<body>

<div class="container">

    <h2>Add Product</h2>

    <form method="POST" action="/products">
        @csrf

        <label>Product Name</label>
        <input type="text" name="name" placeholder="Enter product name" required>

        <label>Price</label>
        <input type="number" name="price" placeholder="Enter price" required>

        <label>Status</label>
        <select name="status">
            <option value="Available">Available</option>
            <option value="Out of Stock">Out of Stock</option>
        </select>

        <button type="submit">Save Product</button>
    </form>

    <a href="/products" class="back">← Back to Products</a>

</div>

</body>
</html>