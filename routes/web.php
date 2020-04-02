<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'admin/');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('books', 'BooksController');
    Route::resource('publishers', 'PublishersController')->except([
        'show', 'update', 'create'
    ]);
    Route::resource('person', 'PersonController')->except([
        'show', 'update', 'create'
    ]);
    Route::resource('borrow', 'BorrowController')->except([
        'show', 'destroy'
    ]);
    Route::get('borrow/{id}/detail', 'BorrowController@show')->name('borrow.show');
    Route::delete('borrow/delete/{id}', 'BorrowController@destroy')->name('borrow.destroy');
});