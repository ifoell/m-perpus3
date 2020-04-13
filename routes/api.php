<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'books'], function () {
    Route::get('getall', 'BooksController@apibooks');
    Route::post('/get_title', 'Select2Controller@books_title');
    Route::get('/read/{id}', 'BooksController@apireadbooks');
    Route::post('add', 'BooksController@apiaddbooks');
    Route::put('/edit/{id}', 'BooksController@apiupdatebooks');
    Route::delete('/delete/{id}', 'BooksController@apideletebooks'); 
});

Route::group(['prefix' => 'publishers'], function () {
    Route::get('getall', 'publishersController@apipublishers');
    Route::post('/get_name', 'Select2Controller@publisher_name');
});

Route::group(['prefix' => 'person'], function () {
    Route::post('/get_name', 'Select2Controller@person_name');
});

Route::post('/roles', 'Select2Controller@roles');