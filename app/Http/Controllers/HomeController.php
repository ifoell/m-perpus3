<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Book;
use App\Publisher;

class HomeController extends Controller
{
    public function index()
    {
        $book = Book::all();
        $publisher = Publisher::all();
        return view('dashboard.index', compact('book','publisher'));
    }
}
