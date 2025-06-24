@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Edit Buku</h1>

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul</label>
                <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring focus:border-purple-500" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="author" class="block text-sm font-semibold text-gray-700 mb-1">Penulis</label>
                <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring focus:border-purple-500" required>
                @error('author')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring focus:border-purple-500" required>{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="rating" class="block text-sm font-semibold text-gray-700 mb-1">Rating (1–5)</label>
                <input type="number" name="rating" id="rating" value="{{ old('rating', $book->rating) }}" min="1" max="5" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring focus:border-purple-500" required>
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="cover" class="block text-sm font-semibold text-gray-700 mb-2">Cover (Opsional)</label>
                <input type="file" name="cover" id="cover" class="file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                @error('cover')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                @if ($book->cover)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Cover saat ini:</p>
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="w-full max-w-md h-auto object-cover rounded-lg shadow">
                    </div>
                @endif
            </div>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('books.index') }}" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300 text-sm">Batal</a>
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition text-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
