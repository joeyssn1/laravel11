<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;500;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Italianno&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
</head>
<body class="bg-maroon flex items-center justify-center min-h-screen font-serif">

    @if(session('success'))
        <p class="text-white text-lg mb-4">{{ session('success') }}</p>
    @endif
    <form action="{{ route('menu.create') }}" method="POST" enctype="multipart/form-data" class="bg-maroon3 p-6 rounded-lg shadow-lg w-full max-w-sm">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-lg font-bold mb-2">Menu Name:</label>
            <input type="text" id="name" name="name" class="w-full p-3 rounded-md bg-gray-200 focus:ring-2 focus:ring-[#582A22] focus:outline-none" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-lg font-bold mb-2">Description:</label>
            <textarea id="description" name="food_description" rows="3" class="w-full p-3 rounded-md bg-gray-200 focus:ring-2 focus:ring-[#582A22] focus:outline-none" required></textarea>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-lg font-bold mb-2">Category:</label>
            <select id="category" name="category_id" class="w-full p-3 rounded-md bg-gray-200 focus:ring-2 focus:ring-[#582A22] focus:outline-none" required>
                <option value="1">Appetizers</option>
                <option value="2">Entrees</option>
                <option value="3">Desserts</option>
                <option value="4">Beverages</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-lg font-bold mb-2">Price:</label>
            <input type="number" id="price" name="price" class="w-full p-3 rounded-md bg-gray-200 focus:ring-2 focus:ring-[#582A22] focus:outline-none" required>
        </div>
        <button type="submit" class="w-full bg-maroon text-white text-lg font-bold py-3 rounded-md hover:bg-[#451f19] transition">Add Menu</button>
    </form>
</body>
</html>
