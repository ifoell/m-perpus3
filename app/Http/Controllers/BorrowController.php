<?php

namespace App\Http\Controllers;

use App\Borrow;
use App\Book;
use App\Person;
use App\Publisher;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $borrow = Borrow::leftJoin('books', 'borrow.book_id', '=', 'books.id')
                    ->leftJoin('person', 'borrow.person_id', '=', 'person.id')
                    ->select(['borrow.id',
                            //   'borrow.ownership',
                              DB::raw("(CASE WHEN (borrow.ownership = 'o' AND person.gender = 'm') THEN 'His'
                                        WHEN (borrow.ownership = 'o' AND person.gender = 'f') THEN 'Hers'
                                        ELSE 'Mine' END) AS ownership"),
                            //   'borrow.status',
                              DB::raw("(CASE WHEN borrow.status = '0' THEN 'Still Borrow' ELSE 'Returned' END) AS status"),
                              'borrow.borrow_at',
                              'borrow.return_at',
                              'books.title',
                              'books.isbn',
                              'person.name',
                              'person.phone'
                            ]);
            
        if ($request->ajax()) {
            
            return Datatables::of($borrow)
                    // ->editColumn('ownership', function($data){
                    //     switch ($data->ownership) {
                    //         case 'o':
                    //             return 'His / Hers';
                    //             break;
                            
                    //         case 'm':
                    //             return 'Mine';
                    //             break;

                    //         default:
                    //             return 'N/A';
                    //             break;
                    //     }
                    // })
                    // ->editColumn('status', function($data){
                    //     switch ($data->status) {
                    //         case '0':
                    //             return 'Still Borrow';
                    //             break;
                            
                    //         case '1':
                    //             return 'Returned';
                    //             break;

                    //         default:
                    //             return 'N/A';
                    //             break;
                    //     }
                    // })
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Show" class="edit btn btn-info btn-sm showBorrow" title="Detail" data-id="'.$data->id.'"><ion-icon name="eye"></ion-icon></a>';
                        $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-primary btn-sm editBorrow" title="Edit" data-id="'.$data->id.'"><ion-icon name="create"></ion-icon></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Return" class="btn btn-success btn-sm returnBorrow" title="Return" data-id="'.$data->id.'"><ion-icon name="caret-back-circle"></ion-icon></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm deleteBorrow" title="Delete" data-id="'.$data->id.'"><ion-icon name="trash"></ion-icon></a>';
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
    public function show($id)
    {
        //read data
        $borrow = Borrow::where('id', $id)->with('book')
                        ->with('person')->get();
        $publisher = Publisher::select('name')->where('id',$borrow[0]->book->publisher_id)->get();
        // pretty_array($publisher[0]->name);
        // die;
        return view('borrow.detail', compact('borrow', 'publisher'));
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
    public function destroy($id)
    {
        $borrow = Borrow::find($id);
        if ($borrow) {
            Borrow::destroy($id);
            return response()->json([
                'success' => 'Data Deleted successfully'
            ]);
        }
    }
}
