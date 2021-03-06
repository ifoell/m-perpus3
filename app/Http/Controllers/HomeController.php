<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
use Harimayco\Menu\Facades\Menu;

use App\Book;
use App\Publisher;
use App\Borrow;
use App\Person;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (is_connected()){
            $client = new Client();
            $request = new \GuzzleHttp\Psr7\Request('GET', 'https://kawalcovid19.harippe.id/api/summary');
            $promise = $client->sendAsync($request)->then(function ($response) {
                return $response->getBody();
            });
            $covidindo = json_decode($promise->wait());

            $request = new \GuzzleHttp\Psr7\Request('GET', 'https://api.kawalcorona.com/indonesia/provinsi/');
            $promise = $client->sendAsync($request)->then(function ($response) {
                return $response->getBody();
            });
            $covidprov = json_decode($promise->wait());
        } else {
            $covidindo = '';
            $covidprov = '';
        }

        $book = Book::all();
        $publisher = Publisher::all();
        $otherBooks = Borrow::where(['ownership' => 'o', 'status' => '0']);
        $person = Person::all();
        $tables = array_map('reset', \DB::select('SHOW TABLES'));
        $tables = \array_diff($tables, ["migrations", "failed_jobs"]);
        return view('dashboard.index', compact('book','publisher','tables','covidindo','covidprov', 'otherBooks', 'person'));
    }
}
