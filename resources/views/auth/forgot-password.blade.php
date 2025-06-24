<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white border border-gray-200 shadow-xl rounded-2xl p-8">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Forgot Password</h1>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 text-sm px-4 py-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 text-sm px-4 py-2 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none transition">
            </div>

            <button type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
                Send Password Reset Link
            </button>

            <div class="text-center text-sm mt-4">
                <a href="{{ route('login') }}" class="text-purple-600 hover:underline font-medium">Back to Login</a>
            </div>
        </form>
    </div>

</body>
</html>
