@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">
    <div class="bg-white shadow-md rounded-xl p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add New Book</h2>

        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-red-600 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>

            <!-- Author -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                <input type="text" name="author" value="{{ old('author') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>{{ old('description') }}</textarea>
            </div>

            <!-- Rating -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rating (1–5)</label>
                <select name="rating"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <option value="">Select Rating</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <!-- Cover Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Book Cover (optional)</label>
                <input type="file" name="cover"
                    class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                           file:rounded-lg file:border-0
                           file:text-sm file:font-semibold
                           file:bg-purple-50 file:text-purple-700
                           hover:file:bg-purple-100">
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit"
                    class="bg-purple-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                    Save Book
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
