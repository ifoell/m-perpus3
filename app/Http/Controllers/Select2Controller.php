<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publisher;
use App\Book;

class Select2Controller extends Controller
{
    public function publisher_name(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $publisher_name = Publisher::orderby('name','asc')->select('id','name')->limit(5)->get();
        } else {
            $publisher_name = Publisher::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search. '%')->limit(5)->get();
        }

        $response = array();
        foreach ($publisher_name as $publisher) {
            $response[] = array(
                "id"=>$publisher->id,
                "name"=>$publisher->name,
            );
        }

        echo json_encode($response);
        exit;
    }
}
