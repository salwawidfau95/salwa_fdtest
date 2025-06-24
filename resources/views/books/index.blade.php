@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 font-sans" x-data="{ deleteId: null, showModal: false }">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-4xl font-bold text-gray-900">Books</h1>
        <a href="{{ route('books.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700 transition duration-200">
            + Add Book
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-300 text-xs uppercase text-gray-700">
                <tr>
                    <th class="px-3 py-2">Cover</th>
                    <th class="px-2 py-2">Title</th>
                    <th class="px-2 py-2">Author</th>
                    <th class="px-2 py-2 text-center">Description</th>
                    <th class="px-2 py-2">Rating</th>
                    <th class="px-2 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($books as $book)
                <tr class="hover:bg-gray-50">
                    <td class="px-3 py-2">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="w-56 h-32 object-cover rounded-md shadow-md">
                        @else
                            <div class="w-56 h-32 bg-gray-200 rounded-md flex items-center justify-center text-gray-400 text-xs">
                                No Image
                            </div>
                        @endif
                    </td>
                    <td class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $book->title }}</td>
                    <td class="px-2 py-2 whitespace-nowrap">{{ $book->author }}</td>
                    <td class="px-2 py-2 text-center max-w-sm">{{ Str::limit($book->description, 80) }}</td>
                    <td class="px-2 py-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-4 w-4 {{ $i <= $book->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.287 3.967a1 1 0 00.95.69h4.175c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.287 3.967c.3.921-.755 1.688-1.54 1.118l-3.38-2.455a1 1 0 00-1.176 0l-3.38 2.455c-.784.57-1.838-.197-1.539-1.118l1.287-3.967a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.175a1 1 0 00.95-.69l1.287-3.967z"/>
                            </svg>
                        @endfor
                    </td>
                    <td class="px-2 py-2 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('books.show', $book) }}" class="text-blue-600 hover:text-blue-800" title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('books.edit', $book) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M16.732 3.732a2.5 2.5 0 113.536 3.536L7 21H3v-4L16.732 3.732z" />
                                </svg>
                            </a>
                            <button @click="showModal = true; deleteId = {{ $book->id }}" class="text-red-600 hover:text-red-800" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>

    <!-- Modal Delete -->
    <div x-show="showModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">Hapus Buku?</h2>
            <p class="text-sm text-gray-600 mb-6">Apakah kamu yakin ingin menghapus buku ini? Tindakan ini tidak bisa dibatalkan.</p>
            <div class="flex justify-end gap-2">
                <button @click="showModal = false" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</button>
                <form :action="'/books/' + deleteId" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/alpinejs" defer></script>
@endsection
