<?php

namespace App\Http\Controllers;

use App\Borrow;
use App\Book;
use App\Person;
use DataTables;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $borrow = Borrow::join('books', 'borrow.book_id', '=', 'books.id')
                    ->join('person', 'borrow.person_id', '=', 'person.id')
                    ->select(['borrow.ownership',
                                'borrow.status',
                                'borrow.borrow_at',
                                'borrow.return_at',
                                'books.title',
                                'books.isbn',
                                'person.name',
                                'person.phone'
                            ]);
                    
        if ($request->ajax()) {
            return Datatables::of($borrow)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm"><ion-icon name="create"></ion-icon></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm deleteBorrow"><ion-icon name="trash"></ion-icon></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('borrow.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('borrow.add');
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
            'book_id'     => 'required',
            'person_id'=> 'required',
            'ownership'    => 'required',
            'borrow_at'    => 'nullable'
        ]);

        Borrow::create($request->all()); //create function
        
        return redirect()->route('borrow.index')
            ->with('success', 'Book added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrow $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrow $borrow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrow $borrow)
    {
        //
    }
}
