<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->get();
        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'file' => 'required | mimes:pdf'
        ]);
        $file = $request->file('file');

        if (isset($file)) {
            //  Make file name
            $fileName = $request->file->getClientOriginalName();

            // Check duplicate
//            if (Book::where('book_name', $fileName) == true) {
//                Toastr::error('This book all ready exist', 'Error');
//                return redirect()->back();
//            }

            //  Create Books folder
            if (!Storage::disk('public')->exists('books')){
                Storage::disk('public')->makeDirectory('books');
            }

            //  put pdf file in folder
            Storage::putFileAs('public/books', $file, $fileName);

        } else {
            return redirect()->back();
        }

        $pdfFile = new Book();
        $pdfFile->name = $request->name;
        $pdfFile->book_name = $fileName;

        if (isset($request->status)) {
            $pdfFile->status = true;
        } else {
            $pdfFile->status = false;
        }

        $pdfFile->save();

        Toastr::success('File Save Successfully', 'Success');
        return redirect()->route('admin.book.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$book->book_name.'"'
        ];

        $path = Storage::disk('public')->path('books/' .$book->book_name);

        return response()->file($path, $headers);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('admin.book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

        $this->validate($request, [
            'name' => 'required',
            'pdf' => 'mimes:pdf'
        ]);
        $file = $request->file('file');

        if (isset($file)) {
            //  make file name
            $fileName = $request->file->getClientOriginalName();

            // Check duplicate
            if (Book::where('book_name', $fileName)) {
                Toastr::error('This book all ready exist', 'Error');
                return redirect()->back();
            }

            //  Create Books folder
            if (!Storage::disk('public')->exists('books')){
                Storage::disk('public')->makeDirectory('books');
            }

            //  Delete old file
            if (Storage::disk('public')->exists('books/'. $book->book_name)) {
                Storage::disk('public')->delete('books/'. $book->book_name);
            }

            //  put pdf file in folder
            Storage::putFileAs('public/books', $file, $fileName);
        } else {
            $fileName = $book->book_name;
        }

        $book->name = $request->name;
        $book->book_name = $fileName;

        if (isset($request->status)) {
            $book->status = true;
        } else {
            $book->status = false;
        }

        $book->update();

        Toastr::success('File Save Successfully', 'Success');
        return redirect()->route('admin.book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if (Storage::disk('public')->exists('books/' .$book->book_name)) {
            Storage::disk('public')->delete('books/' .$book->boke_name);
        }

        $book->delete();

        Toastr::success('Book Delete Successfully', 'Success');
        return redirect()->back();
    }
}
