<?php

namespace App\Http\Controllers\Auth;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function allBook()
    {
        $books = Book::latest()->published()->get();
        return view('auth.all-book', compact('books'));
    }

    public function viewBook ($id)
    {
        $view = Book::findOrFail($id);
    }

    public function downloadBook($id)
    {
        $book = Book::findOrFail($id);

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename = "' .$book->book_name.'"'
        ];
        $path = Storage::disk('public')->url('books/'. $book->book_name);

        return response()->download($path);
//        return response()->download($path, $book->book_name, $headers);
    }
}
