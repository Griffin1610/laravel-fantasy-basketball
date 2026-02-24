<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NBA Stats Builder</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('app.css') }}">
    @endif
</head>

<body class="bg-[#0a0a0a] text-[#EDEDEC] flex items-center justify-center min-h-screen p-6">

    <main class="flex flex-col items-center text-center space-y-20">
        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight">Welcome to your <span class="text-red-600">NBA</span><span class="text-blue-600"> Stats Builder</span></h1>
        @if (Route::has('login'))
            <div class="flex gap-6 mt-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="px-8 py-3 mx-4 rounded-lg bg-blue-600 text-white font-medium text-lg hover:bg-blue-700">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-8 py-3 mx-4 rounded-lg bg-blue-600 text-white font-medium text-lg hover:bg-blue-700">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-8 py-3 mx-4 rounded-lg bg-red-600 text-white font-medium text-lg hover:bg-red-700">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </main>
</body>
</html>
