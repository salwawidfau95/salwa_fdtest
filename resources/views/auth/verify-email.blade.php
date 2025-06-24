<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white border border-gray-200 shadow-xl rounded-2xl p-8 text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Verify Your Email</h1>

        @if (session('message'))
            <div class="bg-green-100 text-green-700 text-sm px-4 py-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <p class="text-gray-700 mb-6">
            We've sent a verification link to your email address.<br>
            Please check your inbox and click the link to activate your account.
        </p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="text-red-500 text-sm hover:underline">
                Logout
            </button>
        </form>
    </div>

</body>
</html>
