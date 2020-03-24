<?php

// Home
// Breadcrumbs::for('home', function ($trail) {
//     $trail->push('Home', route('home'));
// });

// Home > Books
// Breadcrumbs::for('books', function ($trail) {
//     // $trail->parent('home');
//     $trail->push('Books', route('books'));
//     // $trail->push('Books', route('books'));
// });

Breadcrumbs::for('books', function ($trail) {
    $trail->push('Books', route('books.index'));
});

// Books > Add
Breadcrumbs::for('add', function ($trail) {
    $trail->parent('books');
    $trail->push('Add', route('books.create'));
});

// Books > show/edit > title

Breadcrumbs::for('book', function ($trail, $book) {
    $trail->parent('books');
    $trail->push($book->title, route('books.show', $book->id));
});