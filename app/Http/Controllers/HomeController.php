<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\Publisher;

class HomeController extends Controller
{
    public function index()
    {
        $book = Book::all();
        $publisher = Publisher::all();
        $tables = array_map('reset', \DB::select('SHOW TABLES'));
        $tables = \array_diff($tables, ["migrations", "failed_jobs"]);
        return view('dashboard.index', compact('book','publisher','tables'));
    }
}
