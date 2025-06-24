<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $books = Book::with('user')->where('user_id', Auth::id())->paginate(10);
        return view('books.index', compact('books'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $books = $user->books;

        return view('dashboard', [
            'bookCount' => $books->count(),
            'averageRating' => $books->avg('rating'),
            'latestBook' => $books->sortByDesc('created_at')->first(),
            'books' => $books->sortByDesc('created_at')->take(5),
        ]);
    }

    public function landing(Request $request)
    {
        $query = Book::with('user');

        // Filter by author
        if ($request->filled('author')) {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Filter by upload date
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $books = $query->latest()->paginate(9);

        return view('landing', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'description' => 'required|string',
            'rating'      => 'required|integer|between:1,5',
            'cover'       => 'nullable|image|max:2048',
        ]);

        // Simpan file cover jika diupload
        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Tambahkan ID user login
        $validated['user_id'] = Auth::id(); // ⬅️ Ini yang penting!

        // Simpan ke database
        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $this->authorize('view', $book);
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'cover' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated.');
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted.');
    }
}
