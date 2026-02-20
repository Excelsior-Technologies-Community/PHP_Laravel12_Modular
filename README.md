# PHP_Laravel12_Modular


## Project Description

A Laravel 12 Modular Application demonstrating how to build a scalable and maintainable Laravel project using a modular architecture.

Each feature is separated into its own module, making the system clean, reusable, and easy to manage.

#### This project includes example modules:

1. Auth Module

2. User Module

3. Product Module


## Features

- Laravel 12 Modular Architecture

- Automatic Module Route Loading

- PSR-4 Autoloading for Modules

- Separate Controllers per Module

- Clean Folder Structure

- Easy to Scale and Maintain

- Beginner Friendly


## Requirements

- PHP >= 8.2

- Composer

- Laravel 12

- MySQL (optional)

- XAMPP / Laragon / WAMP



## How Modular System Works

- Each feature is placed inside `app/Modules`

- Each module has its own Routes and Controllers

- ModuleServiceProvider automatically loads all module routes

- New modules can be added without touching main routes file



---



## Installation Steps


---


## STEP 1: Create Laravel 12 Project

### Open terminal / CMD and run:

```
composer create-project laravel/laravel PHP_Laravel12_Modular "12.*"

```

### Go inside project:

```
cd PHP_Laravel12_Modular

```

#### Explanation:

This command installs Laravel 12 and creates a new project folder named PHP_Laravel12_Modular.

The cd command moves into the project directory so you can start working on it.





## STEP 2: Database Setup (Optional)

### Open .env and set:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12_Modular
DB_USERNAME=root
DB_PASSWORD=

```

### Create database in MySQL / phpMyAdmin:

```
Database name: laravel12_Modular

```

#### Explanation:

This step connects your Laravel application to the MySQL database.

It allows Laravel to store and retrieve data such as users, products, and other records.




## STEP 3: Setup PSR‑4 Autoloading for Modules

### Edit composer.json.

#### Find:

```

"autoload": {

Replace with:

"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Modules\\": "app/Modules/"
    }
},

```

### Then run:

```
composer dump-autoload

```

#### Explanation:

This step tells Composer and Laravel where your modules are located.

It enables Laravel to automatically load module classes without manual include.




## STEP 4: Create Modules Directory

### Run these one by one:

#### Run: 

```
mkdir app\Modules

```


#### Run: 

```
mkdir app\Modules\Auth

mkdir app\Modules\Auth\Controllers

mkdir app\Modules\Auth\Routes

```


#### Run: 

```
mkdir app\Modules\User

mkdir app\Modules\User\Controllers

mkdir app\Modules\User\Routes

```



#### Run: 

```
mkdir app\Modules\Product

mkdir app\Modules\Product\Controllers

mkdir app\Modules\Product\Routes

```

#### Explanation:

This step creates separate folders for each module.

Each module contains its own controllers and routes, keeping the system organized.





## STEP 5: Create Module Loader

### Create file:

```
app/Providers/ModuleServiceProvider.php

```


### app/Providers/ModuleServiceProvider.php

```
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use File;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $modules = File::directories(app_path('Modules'));

        foreach ($modules as $module) {
            $routeFiles = glob($module.'/Routes/*.php');

            foreach ($routeFiles as $route) {
                $this->loadRoutesFrom($route);
            }
        }
    }

    public function register() {}
}

```


#### Explanation:

This service provider automatically loads routes from all modules.

It eliminates the need to manually register each module route.





## STEP 6: Register the ServiceProvider

### Open This File

```
bootstrap/app.php

```

### Modify it like this:

```
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Providers\ModuleServiceProvider;

return Application::configure(basePath: dirname(__DIR__))

    ->withProviders([
        ModuleServiceProvider::class,
    ])

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        //
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();

```


#### Explanation:

This step registers the ModuleServiceProvider in Laravel.

Now Laravel will automatically detect and load all modules.





## STEP 7: Create Module: Auth

1. Routes

### File: app/Modules/Auth/Routes/web.php

#### Code:

```
<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\AuthController;

Route::prefix('auth')->group(function() {
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'doLogin']);
});

```

2. Controller

### File: app/Modules/Auth/Controllers/AuthController.php

#### Code:

```
<?php

namespace Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        return redirect('/users');
    }
}

```




3. Create View File

### resources/views/auth/login.blade.php


```

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Laravel Modular</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: white;
            padding: 40px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: fadeIn 0.5s ease;
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102,126,234,0.5);
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background: #667eea;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #5a67d8;
        }

        .footer-text {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: #777;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 10px;
        }

    </style>

</head>
<body>

<div class="login-container">

    <div class="logo">
        Laravel Modular
    </div>

    <h1>Login</h1>

    <form method="POST" action="/auth/login">
        @csrf

        <div class="input-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="login-btn">
            Login
        </button>

        <div class="footer-text">
            Laravel 12 Modular System
        </div>

    </form>

</div>

</body>
</html>

```


####  Explanation:

The Auth module handles login functionality.

It includes login routes, controller logic, and login view.





## STEP 8: Create Module: User

1. Routes

### File: app/Modules/User/Routes/web.php

#### Code:

```
<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);

```

2. Controller

### File: app/Modules/User/Controllers/UserController.php

#### Code:

```
<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = ['Alice', 'Bob', 'Charlie'];
        return view('user.index', compact('users'));
    }
}

```


3. Create View File

### resources/views/user/index.blade.php


```
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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

        table th, table td {
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

```


#### Explanation:

The User module manages user-related features.

It displays a list of users using modular architecture.





## STEP 9: Create Module: Product

1. Routes

### File: app/Modules/Product/Routes/web.php

#### Code:

```
<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);

```

2. Controller

### File: app/Modules/Product/Controllers/ProductController.php

#### Code:

```
<?php

namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = ['TV', 'Mobile', 'Laptop'];
        return view('product.index', compact('products'));
    }
}

```


3. Create View File

### resources/views/product/index.blade.php

```
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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

        table th, table td {
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

    <div class="header">
        <h1>Product List</h1>
        <a href="#" class="add-btn">+ Add Product</a>
    </div>

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

```

#### Explanation:

The Product module manages product-related features.

It displays product list independently from other modules.




## STEP 10: Launch the Server

### Run:

```
php artisan serve

```
### Then open your browser:

```
http://localhost:8000/auth/login

http://localhost:8000/users

http://localhost:8000/products

```

#### Explanation:

This command starts Laravel development server.

You can now access all modules through your browser.






## So you can see this type Output:


### Auth Login Page:


<img width="1908" height="962" alt="Screenshot 2026-02-20 115948" src="https://github.com/user-attachments/assets/a882064b-1f44-4760-877e-a4e2ecabdbde" />


### User Page:


<img width="1919" height="938" alt="Screenshot 2026-02-20 115958" src="https://github.com/user-attachments/assets/dbb338b8-f048-472e-a00b-2d69fb686737" />


### Product Page:


<img width="1919" height="950" alt="Screenshot 2026-02-20 134950" src="https://github.com/user-attachments/assets/466767dc-a945-4aae-8016-5b56666f1530" />




---

# Project Folder Structure:

```
PHP_Laravel12_Modular
│
├── app
│   ├── Modules
│   │   ├── Auth
│   │   │   ├── Controllers
│   │   │   │   └── AuthController.php
│   │   │   └── Routes
│   │   │       └── web.php
│   │   │
│   │   ├── User
│   │   │   ├── Controllers
│   │   │   │   └── UserController.php
│   │   │   └── Routes
│   │   │       └── web.php
│   │   │
│   │   └── Product
│   │       ├── Controllers
│   │       │   └── ProductController.php
│   │       └── Routes
│   │           └── web.php
│   │
│   └── Providers
│       └── ModuleServiceProvider.php
│
├── resources
│   └── views
│       ├── auth
│       │   └── login.blade.php
│       ├── user
│       │   └── index.blade.php
│       └── product
│           └── index.blade.php
│
├── bootstrap
├── routes
├── composer.json
└── README.md

```
