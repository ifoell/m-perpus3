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
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'auth.lock']], function () { //use auth middleware for login and auth.lock for lock screen
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('menu','MenusController@index')->name('menu.get');
    Route::resource('books', 'BooksController')->except([
        'destroy'
    ]);
    Route::group(['prefix' => 'books'], function () {
        Route::delete('delete/{id}', 'BooksController@destroy')->name('books.destroy');
    });
    Route::resource('publishers', 'PublishersController')->except([
        'show', 'update', 'create'
    ]);
    Route::resource('person', 'PersonController')->except([
        'show', 'update', 'create'
    ]);
    Route::resource('borrow', 'BorrowController')->except([
        'show', 'edit', 'destroy'
    ]);
    Route::group(['prefix' => 'borrow'], function () {
        Route::get('{id}/detail', 'BorrowController@show')->name('borrow.show');
        Route::get('{id}/edit', 'BorrowController@edit')->name('borrow.edit');
        Route::delete('delete/{id}', 'BorrowController@destroy')->name('borrow.destroy');
        Route::put('return/{id}', 'BorrowController@return')->name('borrow.return');
    });
    Route::resource('user', 'UserController')->except([
        'show', 'edit', 'destroy'
    ]);
    Route::group(['prefix' => 'user'], function () {
        Route::get('{id}/edit', 'UserController@edit')->name('user.edit');
        Route::delete('delete/{id}', 'UserController@destroy')->name('user.destroy');
        Route::get('changepwd', 'UserController@changePwd')->name('user.changepwd');
        Route::post('changepwd', 'UserController@change')->name('user.change');
    });
    Route::resource('roles', 'RolesController')->except([
        'show', 'update', 'create'
    ]);
});

//auth
Auth::routes();
// auth lock or lock screen
Route::get('login/locked', 'Auth\LoginController@locked')->middleware('auth')->name('login.locked');
Route::post('login/locked', 'Auth\LoginController@unlock')->name('login.unlock');

Route::get('/home', 'HomeController@index')->name('home');
