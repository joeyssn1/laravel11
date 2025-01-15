<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>

    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;500;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Italianno&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-maroon font-antiquity flex items-center justify-center min-h-screen">
    <div class="text-center">
        <!-- Payment Options -->
        <form action="PUT", method="POST">
            <div class="flex space-x-10 text-2xl justify-center">
                <label>
                    <input type="radio" name="payment" class="peer hidden" />
                    <div class="hover:text-white peer-checked:text-bone cursor-pointer">QR</div>
                </label>
                <label>
                    <input type="radio" name="payment" class="peer hidden" />
                    <div class="hover:text-white peer-checked:text-bone cursor-pointer">Debit</div>
                </label>
                <label>
                    <input type="radio" name="payment" class="peer hidden" />
                    <div class="hover:text-white peer-checked:text-bone cursor-pointer">Cash</div>
                </label>
            </div>
        </form>
        <!-- Pay Out Button -->
        <button
            class="mt-10 px-6 py-2 text-lg bg-[#d28c82] hover:bg-[#c76d6d] text-white rounded transition duration-300">
            <a href="/home">Pay Out</a>
        </button>
    </div>
</body>

</html>
