<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-maroon text-white font-sans">

    <!-- Header -->
    <x-navigation></x-navigation>

    <!-- Title and Links Section -->
    <div class="text-center mt-20 font-antiquity">
        <h2 class="text-3xl font-bold tracking-widest">Santo's Menu</h2>
        
        <!-- Links Section -->
        <div class="mt-8 space-x-8">
            <!-- Link Category -->
            <a href="{{ route('menu.index', ['category' => 'all']) }}" class="text-bone hover:text-maroon3 text-xl">All</a>

                <!-- Soo This for every Category will be Repeat till nothing left using Foreach -->
            @foreach ($categories as $category)
                <a href="{{ route('menu.index', ['category' => $category->id]) }}" class="text-bone hover:text-maroon3 text-xl">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Menu Section -->
    <main class="p-8">
        <table class="w-full border-collapse border border-gray-500">
            <thead>
                <tr>
                    <th class="p-2 border text-bone text-center">ID</th>
                    <th class="p-2 border text-bone">Menu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td class="p-2 border text-bone text-center">ID: {{ $menu->id }}</td>
                        <td class="p-2 border text-bone">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="w-24 h-24 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold">{{ $menu->name }}</h3>
                                    <p class="text-sm mt-2">{{ $menu->food_description }}</p>
                                    <div class="flex items-center justify-end space-x-4 mt-4 w-full">
                                        <span class="text-lg font-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                        <form method="POST" action="{{ route('menu.order', ['id' => $menu->id]) }}">
                                            @csrf
                                            @if (isset($quantities[$menu->id]) && $quantities[$menu->id] > 0)
                                                <div class="flex items-center space-x-2">
                                                    <button type="submit" name="action" value="decrease"
                                                        class="bg-gray-500 hover:bg-gray-400 text-white px-3 py-1 rounded">-</button>
                                                    <span class="text-lg font-bold">{{ $quantities[$menu->id] }}</span>
                                                    <button type="submit" name="action" value="increase"
                                                        class="bg-gray-500 hover:bg-gray-400 text-white px-3 py-1 rounded">+</button>
                                                </div>
                                            @else
                                                <button type="submit" name="action" value="order"
                                                    class="bg-maroon3 hover:bg-maroon2 text-white px-4 py-2 rounded">
                                                    ORDER
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </main>

    <div class="text-center mt-8">
        
        <a href="/payment" class="bg-maroon3 hover:bg-maroon2 text-white px-6 py-3 rounded text-xl font-bold">
            Pay Out
        </a>
    </div>
    
</body>

</html>