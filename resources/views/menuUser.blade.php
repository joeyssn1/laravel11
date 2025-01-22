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
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-maroon text-white font-sans">

    <!-- Header -->
    <x-navigation></x-navigation>

    <!-- Title and Links Section -->
    <div class="text-center mt-20 font-antiquity">
        <h2 class="text-3xl font-bold tracking-widest">Santo's Menu</h2>
        
        <!-- Links Section -->
        <div class="mt-8 space-x-8">
            <a href="{{ route('menu.index', ['category' => 'all']) }}" class="text-bone hover:text-maroon3 text-xl">All</a>

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
                                    <form method="POST" action="{{ route('menu.order', ['id' => $menu->id]) }}" class="quantity-form">
                                        @csrf
                                        <div class="flex items-center space-x-2">
                                            <!-- Decrease Button -->
                                            <button type="button" class="bg-gray-500 hover:bg-gray-400 text-white px-3 py-1 rounded decrease-btn"
                                                @if (!isset($quantities[$menu->id]) || $quantities[$menu->id] <= 0) disabled @endif>
                                                -
                                            </button>
                
                                            <!-- Quantity Display -->
                                            <span class="text-lg font-bold quantity-display">
                                                {{ $quantities[$menu->id] ?? 0 }}
                                            </span>
                
                                            <!-- Increase Button -->
                                            <button type="button" class="bg-gray-500 hover:bg-gray-400 text-white px-3 py-1 rounded increase-btn">
                                                +
                                            </button>
                
                                    
                                        </div>
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
        <form action="{{ route('menu.addToCart') }}" method="POST">
            @csrf
            <button type="submit" class="bg-maroon3 hover:bg-maroon2 text-white px-6 py-3 rounded text-xl font-bold">
                Add to Cart
            </button>
        </form>
    </div>

    <!-- Add error message display -->
    @if(session('error'))
        <div class="text-center mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- JavaScript -->
      <script>
    document.querySelectorAll('.quantity-form').forEach(form => {
        const id = form.dataset.id;
        const decreaseBtn = form.querySelector('.decrease-btn');
        const increaseBtn = form.querySelector('.increase-btn');
        const quantityDisplay = form.querySelector('.quantity-display');

        const updateQuantity = async (action) => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ action: action })
            });

            if (response.ok) {
                const data = await response.json();
                quantityDisplay.textContent = data.quantity;

                // Enable/Disable buttons based on quantity
                decreaseBtn.disabled = data.quantity <= 0;
                increaseBtn.disabled = false;
            } else {
                console.error('Failed to update quantity');
            }
        };

        decreaseBtn.addEventListener('click', () => updateQuantity('decrease'));
        increaseBtn.addEventListener('click', () => updateQuantity('increase'));
    });
</script>


</body>

</html>
