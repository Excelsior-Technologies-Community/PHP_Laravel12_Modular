<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto py-10 px-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Analytics Dashboard</h1>
            <div class="flex gap-4">
                <a href="/products" class="text-blue-600 hover:underline">Manage Products</a>
                <a href="/users" class="text-blue-600 hover:underline">Manage Users</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500">
                <h2 class="text-lg text-gray-500 font-semibold mb-1">Total Users</h2>
                <p class="text-4xl font-bold text-gray-800">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500">
                <h2 class="text-lg text-gray-500 font-semibold mb-1">Total Products</h2>
                <p class="text-4xl font-bold text-gray-800">{{ $totalProducts }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h3 class="font-bold text-gray-700">Recently Added Products</h3>
                </div>
                <div class="p-6">
                    <ul class="divide-y divide-gray-200">
                        @forelse($recentProducts as $product)
                            <li class="py-3 flex justify-between">
                                <span class="font-medium text-gray-800">{{ $product->name }}</span>
                                <span class="text-gray-500">₹{{ $product->price }}</span>
                            </li>
                        @empty
                            <li class="py-3 text-gray-500">No products found.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h3 class="font-bold text-gray-700">Newest Users</h3>
                </div>
                <div class="p-6">
                    <ul class="divide-y divide-gray-200">
                        @forelse($recentUsers as $user)
                            <li class="py-3 flex justify-between">
                                <span class="font-medium text-gray-800">{{ $user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $user->email }}</span>
                            </li>
                        @empty
                            <li class="py-3 text-gray-500">No users found.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>