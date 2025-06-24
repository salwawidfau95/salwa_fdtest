@extends('layouts.app')

@section('content')
<div class="px-6 py-8 font-sans bg-gray-50 min-h-screen">
    <!-- User Info -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex items-center gap-5 mb-8">
        <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xl font-bold">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div>
            <h2 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
            <span class="text-xs font-medium px-2 py-1 rounded-full mt-1 inline-block
                {{ Auth::user()->hasVerifiedEmail() ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ Auth::user()->hasVerifiedEmail() ? '✔ Email Verified' : '✖ Belum Verifikasi' }}
            </span>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
        <!-- Total Buku -->
        <div class="rounded-2xl bg-gradient-to-br from-purple-100 to-purple-50 p-5 shadow border border-purple-200">
            <p class="text-sm font-medium text-purple-800 mb-1">Total Buku</p>
            <p class="text-3xl font-bold text-purple-900">{{ $bookCount }}</p>
        </div>
        <!-- Rata-rata -->
        <div class="rounded-2xl bg-gradient-to-br from-yellow-100 to-yellow-50 p-5 shadow border border-yellow-200">
            <p class="text-sm font-medium text-yellow-700 mb-1">Rata-Rata Rating</p>
            <p class="text-3xl font-bold text-yellow-800">{{ number_format($averageRating, 1) }}</p>
        </div>
        <!-- Buku Terakhir -->
        <div class="rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 p-5 shadow border border-blue-200">
            <p class="text-sm font-medium text-blue-700 mb-1">Buku Terakhir</p>
            <p class="text-md font-semibold text-blue-900">{{ $latestBook?->title ?? 'Belum ada' }}</p>
        </div>
    </div>

    <!-- Buku Terbaru List -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">📚 Buku Terbaru Kamu</h3>
            <a href="{{ route('books.index') }}" class="text-sm text-indigo-600 hover:underline">Lihat Semua</a>
        </div>

        @forelse($books->take(5) as $book)
            <div class="flex items-center p-3 hover:bg-gray-50 rounded-md transition mb-2">
                @if ($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="w-14 h-20 object-cover rounded border shadow-sm">
                @else
                    <div class="w-14 h-20 bg-gray-200 flex items-center justify-center text-xs text-gray-500 rounded">
                        No Image
                    </div>
                @endif
                <div class="ml-4 flex-1">
                    <p class="font-medium text-gray-800">{{ $book->title }}</p>
                    <p class="text-sm text-gray-500">{{ $book->author }}</p>
                    <div class="text-xs text-gray-400 mt-1">
                        ⭐ {{ $book->rating }} • {{ $book->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center py-4 text-sm">Belum ada buku yang ditambahkan.</p>
        @endforelse
    </div>
</div>
@endsection
