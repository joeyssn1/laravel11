<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;500;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Italianno&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="bg-maroon flex items-center justify-center min-h-screen font-antiquity">

    <div class="bg-maroon2 p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-bone text-3xl font-bold mb-4 text-center">Santo's Restaurant</h1>
        <div class="text-bone text-sm mb-6 text-left">
            <div class="flex items-left justify-center space-x-2 text-bone text-lg font-antiquity mb-4">
                <a href="{{ route('login') }}" class="font-semibold text-bone">Login</a>
                <span class="text-gray-400">|</span>
                <a href="{{ route('register') }}" class="text-gray-300 hover:text-bone">Register</a>
            </div>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-white">Username</label>
                    <input type="text" id="username" name="username" required
                        class="w-full px-4 py-2 rounded bg-white text-gray-700 focus:outline-none">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-white">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 rounded bg-white text-gray-700 focus:outline-none">
                </div>

                @if ($errors->any())
                    <div class="text-red-500 mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded">
                    SIGN IN
                </button>
            </form>

        </div>
</body>

</html>
