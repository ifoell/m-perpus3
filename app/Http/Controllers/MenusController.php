<?php

namespace App\Http\Controllers;

use App\menus;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menus.menu');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function show(menus $menus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function edit(menus $menus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, menus $menus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\menus  $menus
     * @return \Illuminate\Http\Response
     */
    public function destroy(menus $menus)
    {
        //
    }
}
