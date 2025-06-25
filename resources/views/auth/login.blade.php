<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
</head>
<body class="min-h-screen flex items-center justify-center relative">

    <!-- Tombol Back -->
    <a href="{{ route('landing') }}"
        class="absolute top-10 left-10 flex items-center gap-1 px-4 py-2 rounded-full bg-purple-100 shadow hover:bg-purple-200 border border-purple-300 transition text-sm font-medium text-purple-700 hover:text-purple-800">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back
    </a>

  <div class="w-full max-w-4xl flex shadow-2xl rounded-2xl overflow-hidden border border-gray-200 bg-overlay">
    <!-- Left Panel -->
    <div class="hidden md:flex w-1/2 bg-gradient-to-br from-purple-700 to-purple-500 items-center justify-center p-10">
      <div class="text-white text-center">
        <h2 class="text-3xl font-bold mb-3 tracking-wide">Welcome Back</h2>
        <p class="text-lg opacity-80">Sign in to manage your dashboard</p>
      </div>
    </div>

    <!-- Right Form -->
    <div class="w-full md:w-1/2 p-8 md:p-10">
      <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">Login</h2>
        <p class="text-sm text-gray-500">Access your account</p>
      </div>

      @if ($errors->any())
      <div class="bg-red-100 text-red-600 text-sm p-3 rounded mb-4">
        {{ $errors->first() }}
      </div>
      @endif

      <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" required autofocus
            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none transition" />
        </div>

        <!-- Password -->
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <div class="relative">
            <input type="password" id="password" name="password" required
              class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none transition pr-10" />
            <span onclick="togglePassword()"
              class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gray-800">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </span>
          </div>
        </div>

        <!-- Forgot password -->
        <div class="flex items-center justify-between text-sm">
          <a href="{{ route('password.request') }}" class="text-purple-600 hover:underline">Forgot password?</a>
        </div>

        <!-- Login button -->
        <button type="submit"
          class="w-full bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
          Login
        </button>

        <!-- Register -->
        <div class="text-center text-sm mt-6">
          Don't have an account?
          <a href="{{ route('register') }}" class="text-purple-600 hover:underline font-medium">Register</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const eyeIcon = document.getElementById("eyeIcon");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.setAttribute("stroke", "#7e22ce");
      } else {
        passwordInput.type = "password";
        eyeIcon.setAttribute("stroke", "#6b7280");
      }
    }
  </script>
</body>
</html>
