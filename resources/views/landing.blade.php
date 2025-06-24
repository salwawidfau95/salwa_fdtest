<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-800">
    
<div class="w-full flex justify-between items-center px-6 py-4 bg-white shadow">
    <div class="text-xl font-bold text-purple-700">Books App</div>
    <div>
        <a href="{{ route('register') }}"
            class="text-sm text-purple-700 hover:underline mr-4 font-semibold">Daftar</a>
        <a href="{{ route('login') }}"
            class="bg-purple-600 text-white px-4 py-2 rounded-md text-sm hover:bg-purple-700 font-semibold">Login</a>
    </div>
</div>

<!-- Hero Section -->
<section class="bg-gradient-to-b from-purple-100 to-white py-16">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <h1 class="text-4xl font-bold text-purple-800 mb-4">📚 Temukan Buku Favoritmu</h1>
    <p class="text-gray-600 mb-6">Eksplorasi ribuan buku dari berbagai genre & penulis inspiratif</p>
    <a href="#book-list" class="bg-purple-600 text-white px-6 py-3 rounded-full hover:bg-purple-700 transition shadow-lg">
      Jelajahi Sekarang
    </a>
  </div>
</section>

<!-- Filter Form -->
<section class="bg-white shadow-lg rounded-xl p-6 mt-[-40px] max-w-6xl mx-auto relative z-10">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label for="from" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="author" placeholder="Author"
                value="{{ request('author') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
        </div>

        <div>
            <label for="from" class="block text-sm font-medium text-gray-700 mb-1">Rate</label>
            <select name="rating"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                <option value="">Rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
                @endfor
            </select>
        </div>

        <div>
            <label for="from" class="block text-sm font-medium text-gray-700 mb-1">Dari</label>
            <input type="date" name="from" id="from" value="{{ request('from') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
        </div>

        <div>
            <label for="to" class="block text-sm font-medium text-gray-700 mb-1">Sampai</label>
            <input type="date" name="to" id="to" value="{{ request('to') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
        </div>

        <div class="md:col-span-4 flex flex-wrap gap-3 mt-2">
            <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded-md hover:bg-purple-700 transition">
                Filter
            </button>
            <a href="{{ route('landing') }}" class="bg-gray-200 px-5 py-2 rounded-md hover:bg-gray-300">
                Reset
            </a>
        </div>
    </form>
</section>

<!-- Buku Section -->
<section id="book-list" class="py-16 bg-gradient-to-b from-white to-purple-50">
  <div class="max-w-7xl mx-auto px-4">
    <h2 class="text-2xl font-bold text-purple-800 mb-8 text-center">📘 Koleksi Buku Terbaru</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($books as $book)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                @if ($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover"
                        class="w-full h-52 object-cover">
                @endif
                <div class="p-4">
                    <h3 class="font-bold text-lg text-purple-800">{{ $book->title }}</h3>
                    <p class="text-sm text-gray-600 mb-1">✍️ {{ $book->author }}</p>
                    <p class="text-sm text-gray-500 mb-2">{{ Str::limit($book->description, 80) }}</p>
                    <p class="text-yellow-500 text-sm">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $book->rating ? '' : 'text-gray-300' }}">★</span>
                        @endfor
                    </p>
                    <p class="text-xs text-gray-400 mt-1">📅 {{ $book->created_at->format('d M Y') }}</p>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">Tidak ada buku ditemukan.</p>
        @endforelse
    </div>

    <div class="mt-10 text-center">
        {{ $books->withQueryString()->links() }}
    </div>
  </div>
</section>

</body>
</html>
