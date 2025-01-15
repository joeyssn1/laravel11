<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;500;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Italianno&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <x-navigation></x-navigation>

    @if(session('success'))
        <p class="text-white text-lg mb-4">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p class="text-red-600 text-lg mb-4">{{ session('error') }}</p>
    @endif

    <form action="{{ route('menu.edit', $menu->id) }}" method="POST" enctype="multipart/form-data" class="bg-maroon3 p-6 rounded-lg shadow-lg w-full max-w-sm">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-lg font-bold mb-2">Menu Name:</label>
            <input type="text" id="name" name="name" value="{{ $menu->name }}" class="w-full p-3 rounded-md bg-gray-200 focus:ring-2 focus:ring-[#582A22] focus:outline-none" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-lg font-bold mb-2">Description:</label>
            <textarea id="description" name="food_description" rows="3" class="w-full p-3 rounded-md bg-gray-200 focus:ring-2 focus:ring-[#582A22] focus:outline-none" required>{{ $menu->food_description }}</textarea>
        </div>
        <div class="mb-4">
            <label for="category" class="block text-lg font-bold mb-2">Category:</label>
            <select id="category" name="category_id" class="w-full p-3 rounded-md bg-gray-200 focus:ring-2 focus:ring-[#582A22] focus:outline-none" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($menu->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-lg font-bold mb-2">Price:</label>
            <input type="number" id="price" name="price" value="{{ $menu->price }}" class="w-full p-3 rounded-md bg-gray-200 focus:ring-2 focus:ring-[#582A22] focus:outline-none" required>
        </div>
        <button type="submit" class="w-full bg-maroon text-white text-lg font-bold py-3 rounded-md hover:bg-[#451f19] transition">Save Changes</button>
    </form>

    <form action="{{ route('menu.delete', $menu->id) }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="w-full bg-red-600 text-white text-lg font-bold py-3 rounded-md hover:bg-red-700 transition">Delete Menu</button>
    </form>
</body>
</html>
