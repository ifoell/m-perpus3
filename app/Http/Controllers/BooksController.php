<?php

namespace App\Http\Controllers;

use App\Book;
use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $q = $request->q;
        //get all data
        $books = Book::with(['publisher'])/*->search($q)*/->orderBy('title', 'ASC')->sortable()->paginate(6);
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
            'title'     => 'required|unique:books',
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
        return view('books.detail', compact('book','publisher'));
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

    // for api

    /**
     * @OA\Get(
     *     path="/api/books/getall",
     *     tags={"Books"},
     *     summary="Returns all Books Data",
     *     description="API Books",
     *     operationId="getbooks",
     *     
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *              @OA\AdditionalProperties(
     *                  type="integer",
     *                  format="int32"
     *              )
     *          )
     *     ),
     *     
     *     @OA\Response(
     *         response="default",
     *         description="Success get all data"
     *     )
     * )
     */

    public function apibooks()
    {
        return Book::with(['publisher'])->orderBy('title', 'ASC')->get();
    }

    /**
     * @OA\Post(
     *     path="/api/books/add",
     *     tags={"Books"},
     *     summary="Add Books",
     *     description="add Books",
     *     operationId="addbooks",
     * 
     *      @OA\Parameter(
     *          name="title",
     *          description="Title",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="author",
     *          description="Author",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     
     *     @OA\Parameter(
     *          name="editor",
     *          description="Editor",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="copy_editor",
     *          description="Copy Editor",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="isbn",
     *          description="ISBN",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="edition",
     *          description="Edition",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="description",
     *          description="Description",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="publisher_id",
     *          description="Publisher",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     
     *     @OA\Response(
     *         response="default",
     *         description="Success get all data"
     *     )
     * )
     */

    public function apiaddbooks(Request $request)
    {
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->editor = $request->editor;
        $book->copy_editor = $request->copy_editor;
        $book->isbn = $request->isbn;
        $book->edition = $request->edition;
        $book->description = $request->description;
        $book->title_translate = $request->title_translate;
        $book->publisher_id = $request->publisher_id;
        $book->save();

        return "Data Saved Successfully";
    }

    /**
     * @OA\Get(
     *     path="/api/books/read/{id}",
     *     tags={"Books"},
     *     summary="Returns selected Book Data",
     *     description="API Books",
     *     operationId="getselectedbooks",
     * 
     *     @OA\Parameter(
     *          name="id",
     *          description="Books ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *              @OA\AdditionalProperties(
     *                  type="integer",
     *                  format="int32"
     *              )
     *          )
     *     ),
     *     
     *     @OA\Response(
     *         response="default",
     *         description="Success get all data"
     *     )
     * )
     */

    public function apireadbooks(Request $request, $id)
    {
        // $publisher_id = $book->publisher_id;
        // $publisher = publisher::find($publisher_id);
        // $publisher_name = $publisher->name;
        $book = Book::with('publisher')->find($id);
        return $book;
    }

    /**
     * @OA\Put(
     *     path="/api/books/edit/{id}",
     *     tags={"Books"},
     *     summary="Edit Books",
     *     description="Edit Books",
     *     operationId="editbooks",
     * 
     *     @OA\Parameter(
     *          name="id",
     *          description="Id Books",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *      @OA\Parameter(
     *          name="title",
     *          description="Title",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="author",
     *          description="Author",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     
     *     @OA\Parameter(
     *          name="editor",
     *          description="Editor",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="copy_editor",
     *          description="Copy Editor",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="isbn",
     *          description="ISBN",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="edition",
     *          description="Edition",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="description",
     *          description="Description",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     * 
     *     @OA\Parameter(
     *          name="publisher_id",
     *          description="Publisher",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     * 
     *     @OA\Response(
     *         response="default",
     *         description="Success get all data"
     *     )
     * )
     */

    public function apiupdatebooks(Request $request, $id)
    {
        $title = $request->title;
        $author = $request->author;
        $editor = $request->editor;
        $copy_editor = $request->copy_editor;
        $isbn = $request->isbn;
        $edition = $request->edition;
        $description = $request->description;
        $title_translate = $request->title_translate;
        $publisher_id = $request->publisher_id;

        $book = Book::find($id);
        $book->title = $title;
        $book->author = $author;
        $book->editor = $editor;
        $book->copy_editor = $copy_editor;
        $book->isbn = $isbn;
        $book->edition = $edition;
        $book->description = $description;
        $book->title_translate = $title_translate;
        $book->publisher_id = $publisher_id;
        $book->save();

        return "Data Updated Successfully";
    }

    /**
     * @OA\Delete(
     *     path="/api/books/delete/{id}",
     *     tags={"Books"},
     *     summary="Returns deleted",
     *     description="API Books",
     *     operationId="deletebooks",
     * 
     *     @OA\Parameter(
     *          name="id",
     *          description="Books ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *              @OA\AdditionalProperties(
     *                  type="integer",
     *                  format="int32"
     *              )
     *          )
     *     ),
     *     
     *     @OA\Response(
     *         response="default",
     *         description="Success get all data"
     *     )
     * )
     */

    public function apideletebooks($id)
    {
        $book = Book::find($id);
        $book->delete();

        return "Data Deleted Successfully";
    }
}
