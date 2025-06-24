@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">

    <div class="flex items-center mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-3 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 0a8 8 0 100 16v-2m0-12h8m-8 0H4" />
        </svg>
        <h1 class="text-3xl font-bold text-gray-800 border-b pb-2">Detail Buku</h1>
    </div>

    <div class="flex flex-col md:flex-row gap-10">
        @if ($book->cover)
            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="w-64 h-96 object-cover rounded-lg shadow-md">
        @else
            <div class="w-64 h-96 bg-gray-100 rounded-md flex items-center justify-center text-gray-400 text-sm">
                Tidak ada gambar
            </div>
        @endif

        <div class="flex-1 space-y-6">
            <!-- Judul -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19.5A2.5 2.5 0 006.5 22H20v-2H6.5a.5.5 0 01-.5-.5V4h-2v15.5z" />
                    </svg>
                    Judul
                </h2>
                <p class="text-xl text-gray-900">{{ $book->title }}</p>
            </div>

            <!-- Penulis -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A8.966 8.966 0 0112 15a8.966 8.966 0 016.879 2.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                    </svg>
                    Penulis
                </h2>
                <p>{{ $book->author }}</p>
            </div>

            <!-- Deskripsi -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-9 4h9" />
                    </svg>
                    Deskripsi
                </h2>
                <p class="bg-gray-50 p-4 rounded-md border text-sm leading-relaxed">{{ $book->description }}</p>
            </div>

            <!-- Rating -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    Rating
                </h2>
                <div>
                    @for ($i = 1; $i <= 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 {{ $i <= $book->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.287 3.967a1 1 0 00.95.69h4.175c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.287 3.967c.3.921-.755 1.688-1.54 1.118l-3.38-2.455a1 1 0 00-1.176 0l-3.38 2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.967a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.175a1 1 0 00.95-.69l1.287-3.967z" />
                        </svg>
                    @endfor
                </div>
            </div>

            <!-- Info Tambahan -->
            <div class="text-sm text-gray-500">
                Ditambahkan pada: {{ $book->created_at->format('d M Y') }}<br>
                Oleh: {{ $book->user->name }}
            </div>
        </div>
    </div>

    <div class="mt-10 flex gap-4">
        <a href="{{ route('books.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">Kembali</a>
        <a href="{{ route('books.edit', $book->id) }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Edit</a>
        <form method="POST" action="{{ route('books.destroy', $book->id) }}" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
        </form>
    </div>

</div>
@endsection
