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

Route::get('/', 'HomeController@index')->name('dashboard');
Route::resource('books', 'BooksController');
Route::resource('publishers', 'PublishersController')->except([
    'show', 'update', 'create'
]);
Route::post('/getpublisher_name', 'Select2Controller@publisher_name')->name('get_publisher');