<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User List - Laravel Modular</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
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

        .logout-btn {
            text-decoration: none;
            background: #e53e3e;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: #c53030;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #667eea;
            color: white;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
        }

        table tbody tr {
            border-bottom: 1px solid #ddd;
            transition: 0.2s;
        }

        table tbody tr:hover {
            background: #f5f7ff;
        }

        .badge {
            padding: 5px 10px;
            background: #48bb78;
            color: white;
            border-radius: 12px;
            font-size: 12px;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            color: #777;
            font-size: 13px;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="header">
            <h1>User List</h1>
            <a href="/auth/login" class="logout-btn">Logout</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user }}</td>
                        <td>
                            <span class="badge">Active</span>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>

        <div class="footer">
            Laravel 12 Modular System
        </div>

    </div>

</body>

</html>