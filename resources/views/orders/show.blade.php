<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Order Details</h1>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Order ID: {{ $order->id }}</h2>
            <p class="mb-2"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p class="mb-4"><strong>Placed on:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>

            <table class="w-full border-collapse border border-gray-300 mb-6">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Menu</th>
                        <th class="border px-4 py-2">Quantity</th>
                        <th class="border px-4 py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->details as $detail)
                        <tr>
                            <td class="border px-4 py-2">{{ $detail->menu->name }}</td>
                            <td class="border px-4 py-2 text-center">{{ $detail->quantity }}</td>
                            <td class="border px-4 py-2 text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p class="text-right text-lg font-semibold">
                <strong>Total:</strong> Rp {{ number_format($order->details->sum('subtotal'), 0, ',', '.') }}
            </p>
        </div>
    </div>
</body>

</html>
