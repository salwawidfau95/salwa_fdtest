<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="bg-white h-screen group flex flex-col justify-between transition-all duration-500 ease-in-out w-20 hover:w-64 p-4 border-r">
        <div class="flex flex-col items-center group-hover:items-start space-y-8 overflow-y-auto">
            <!-- Logo -->
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white text-xl font-bold">
                    B
                </div>
                <span class="text-lg font-semibold text-gray-700 hidden group-hover:block">Books App</span>
            </div>

            <!-- Menu Items -->
            <nav class="flex flex-col space-y-6 w-full items-center group-hover:items-start">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 w-full px-2 py-1 hover:text-purple-600">
                    <svg class="w-6 h-6 mx-auto group-hover:mx-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.5L12 3l9 6.5V21a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1V9.5z"/>
                    </svg>
                    <span class="hidden group-hover:block">Dashboard</span>
                </a>

                <a href="{{ route('books.index') }}" class="flex items-center gap-4 w-full px-2 py-1 hover:text-purple-600">
                    <svg class="w-6 h-6 mx-auto group-hover:mx-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19.5A2.5 2.5 0 006.5 22H20v-2H6.5a.5.5 0 01-.5-.5V4h-2v15.5zM8 4h13v16H8"/>
                    </svg>
                    <span class="hidden group-hover:block">Books</span>
                </a>

                <a href="{{ route('users.index') }}" class="flex items-center gap-4 w-full px-2 py-1 hover:text-purple-600">
                    <svg class="w-6 h-6 mx-auto group-hover:mx-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2m8-10a4 4 0 100-8 4 4 0 000 8z"/>
                    </svg>
                    <span class="hidden group-hover:block">Users</span>
                </a>
            </nav>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button type="submit" class="flex items-center gap-4 text-red-500 hover:text-red-700 w-full px-2 py-2">
                <svg class="w-6 h-6 mx-auto group-hover:mx-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                <span class="hidden group-hover:block">Logout</span>
            </button>
        </form>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col relative">

        <!-- Dropdown -->
        <div class="absolute top-4 right-6 z-50" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 hover:bg-gray-100 px-3 py-2 rounded-full">
                <div class="w-9 h-9 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" @click.away="open = false" x-cloak
                class="mt-2 right-0 w-40 bg-white border rounded shadow-lg absolute">
                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
            </div>
        </div>

        <!-- CONTENT -->
        <main class="p-6 mt-16">
            @yield('header')
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
