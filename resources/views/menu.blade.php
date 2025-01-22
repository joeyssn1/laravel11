<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santo's Menu</title>

    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-maroon text-white font-sans">

    <!-- Header -->
    <x-navigation></x-navigation>

    <div class="font-antiquity">
        <!-- Title -->
        <div class="text-center mt-20 font-antiquity">
            <h2 class="text-3xl font-bold tracking-widest">Santo's Menu</h2>
        </div>

        <!-- Add Menu Button -->
        <div class="flex justify-center mt-6">
            <button class="bg-maroon3 hover:bg-rose-300 text-white px-4 py-2 rounded">
                <a href="/addMenu">Add Menu</a>
            </button>
        </div>

        <!-- Menu List -->
        <div class="mt-10 p-8">
            <h3 class="text-2xl font-semibold mb-6 text-center">Menu Items</h3>
            @if(count($menus) > 0)
                <div id="menu-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($menus as $menu)
                        <div class="bg-maroon3 p-4 rounded-lg shadow-lg">
                            <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="w-full h-40 object-cover rounded-lg mb-4">
                            <h4 class="text-xl font-bold mb-2">{{ $menu->name }}</h4>
                            <p class="text-sm mb-2">{{ $menu->food_description }}</p>
                            <p class="font-bold mb-4">Price: Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                            <div class="flex justify-between">
                                <!-- Edit Button -->
                                <form method="GET" action="{{ route('menu.edit', ['id' => $menu->id]) }}">
                                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                        Edit
                                    </button>
                                </form>
                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('menu.delete', ['id' => $menu->id]) }}">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600">No menu items available</p>
            @endif
        </div>
    </div>

</body>

</html>
