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
        <!-- Total Payments Table -->
        <div class="container mx-auto p-8">
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-white border-bone">
                    <!-- Table Head -->
                    <thead>
                        <tr>
                            <th colspan="4">
                                <h1 class="text-center text-3xl font-bold text-white my-10 ">{{ $pagetitle }}</h1>
                            </th>
                        </tr>
                        <tr class="bg-transparent text-left">
                            <th class="px-4 py-3 border-2">User Id</th>
                            <th class="px-4 py-3 border-2">Username</th>
                            <th class="px-4 py-3 border-2">Total Payment</th>
                            <th class="px-4 py-3 border-2">Status</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody class="text-bone">
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td class="p-2 border-collapse border-2">{{ $order->user->username }}</td>
                                <td class="p-2 border-collapse border-2">{{ $order->user->id }}</td>
                                <td class="p-2 border-collapse border-2">
                                    {{ $order->orderDetail ? number_format($order->orderDetail->sum('subtotal'), 0, ',', '.') : 'N/A' }}
                                <td class="p-2 border-collapse border-2">{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
