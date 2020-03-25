<?php

namespace App\Http\Controllers;

use App\Book;
use App\Publisher;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all data
        $books = Book::with(['publisher'])->orderBy('title', 'ASC')->get();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //redirect to add new book page
        $publishers = Publisher::all();
        return view('books.add', compact('publishers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //form validation
        $request->validate([
            'title'     => 'required',
            'title_translate'=> 'nullable',
            'author'    => 'required',
            'editor'    => 'nullable',
            'copy_editor'=> 'nullable',
            'publisher_id' => 'required',
            'isbn'      => 'required|unique:books',
            'edition'   => 'nullable',
            'description'=> 'nullable'
        ]);

        Book::create($request->all()); //create function
        
        return redirect()->route('books.index')
            ->with('success', 'Book added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //read data
        $publisher_id = $book->publisher_id;
        $publisher = publisher::find($publisher_id);
        $publisher_name = $publisher->name;
        return view('books.detail', compact('book','publisher_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //page edit data
        $publishers = Publisher::all();
        return view('books.edit', compact('book', 'publishers'));
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
        //submit edit
        $request->validate([
            'title'     => 'required',
            'title_translate'=> 'nullable',
            'author'    => 'required',
            'editor'    => 'nullable',
            'copy_editor'=> 'nullable',
            'publisher_id' => 'required',
            'isbn'      => 'required',
            'edition'   => 'nullable',
            'description'=> 'nullable'
        ]);

        $book->update($request->all()); //update function
        
        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //delete data
        $book->delete();
        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully');

    }
}
