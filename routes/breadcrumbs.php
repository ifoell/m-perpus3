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

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('books', function ($trail) {
    $trail->push('Books', route('books.index'));
});

// Books > Add
Breadcrumbs::for('add_book', function ($trail) {
    $trail->parent('books');
    $trail->push('Add Book', route('books.create'));
});

// Books > show/edit > title

Breadcrumbs::for('detail_book', function ($trail, $book) {
    $trail->parent('books');
    $trail->push($book->title, route('books.show', $book->id));
});

Breadcrumbs::for('publisher', function ($trail) {
    $trail->push('Publisher', route('publishers.index'));
});