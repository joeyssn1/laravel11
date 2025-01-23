<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;500;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Italianno&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="bg-maroon font-antiquity">
    <x-navigation></x-navigation>

    <div class="mt-20">
        <div class="container mx-auto p-8">
            @if(!$order || $order_details->isEmpty())
                <div class="text-center text-white p-8">
                    <h2 class="text-2xl font-bold mb-4">Your cart is empty</h2>
                    <p class="mb-4">Add some items to your cart to see them here.</p>
                    <a href="{{ route('menu.index') }}" class="inline-block bg-maroon3 hover:bg-maroon2 text-white px-6 py-3 rounded text-xl font-bold">
                        Go to Menu
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-white border border-bone">
                        <thead>
                            <tr>
                                <th colspan="4">
                                    <h1 class="text-center text-3xl font-bold text-white my-10">{{ $pagetitle }}</h1>
                                </th>
                            </tr>
                            <tr class="bg-transparent text-left">
                                <th class="px-4 py-3 border-b">No</th>
                                <th class="px-4 py-3 border-b">Item Name</th>
                                <th class="px-4 py-3 border-b">Quantity</th>
                                <th class="px-4 py-3 border-b">Price</th>
                            </tr>
                        </thead>
                        <tbody class="text-white">
                            @foreach ($order_details as $index => $order_detail)
                                @php
                                    $bg = $index % 2 === 0 ? 'bg-transparent' : 'bg-transparent';
                                    $menu = $menus->firstWhere('id', $order_detail->menu_id);
                                @endphp
                                <tr class="{{ $bg }}">
                                    <td class="p-2 border-collapse border-b">{{ $index + 1 }}</td>
                                    <td class="p-2 border-collapse border-b">{{ $menu ? $menu->name : 'N/A' }}</td>
                                    <td class="p-2 border-collapse border-b">{{ $order_detail->quantity }}</td>
                                    <td class="p-2 border-collapse border-b">
                                        Rp {{ number_format($order_detail->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-maroon">
                                <td colspan="3" class="px-4 py-3 text-right font-bold">TOTAL PAYMENT:</td>
                                <td class="px-4 py-3 font-bold text-lg">
                                    Rp {{ number_format($order_details->sum('subtotal'), 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('paymentMethod') }}" 
                       class="inline-block bg-maroon3 hover:bg-maroon2 text-white px-6 py-3 rounded text-xl font-bold">
                        Pay Out
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
