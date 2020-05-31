<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publisher;
use App\Book;
use App\Person;
use App\Roles;

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

    public function books_title(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $books_title = Book::orderby('title','asc')->select('id','title')->limit(5)->get();
        } else {
            $books_title = Book::orderby('title','asc')->select('id','title')->where('title', 'like', '%' .$search. '%')->limit(5)->get();
        }

        $response = array();
        foreach ($books_title as $books) {
            $response[] = array(
                "id"=>$books->id,
                "title"=>$books->title,
            );
        }

        echo json_encode($response);
        exit;
    }

    public function person_name(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $person_name = Person::orderby('name','asc')->select('id','name')->limit(5)->get();
        } else {
            $person_name = Person::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search. '%')->limit(5)->get();
        }

        $response = array();
        foreach ($person_name as $person) {
            $response[] = array(
                "id"=>$person->id,
                "name"=>$person->name,
            );
        }

        echo json_encode($response);
        exit;
    }

    public function roles(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $roles = Roles::orderby('name','asc')->select('id','name')->where('is_active', '=', 'y')->limit(5)->get();
        } else {
            $roles = Roles::orderby('name','asc')->select('id','name')->where(['name', 'like', '%' .$search. '%'],['is_active', '=', 'y'])->limit(5)->get();
        }

        $response = array();
        foreach ($roles as $role) {
            $response[] = array(
                "id"=>$role->id,
                "name"=>$role->name,
            );
        }

        echo json_encode($response);
        exit;
    }
}
