@extends('template.layout')

@section('content')
    
    <div class="container mt-5">
        {{ Breadcrumbs::render('book', $book) }}
        <div class="row justify-content-center align-items-center">
            <div class="card col-10">
                <div class="card-header">
                    <h2>{{ $book->title }}</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Title :</b>&nbsp {{ $book->title }}</li>
                        <li class="list-group-item"><b>Author :</b>&nbsp {{ $book->author }}</li>
                        <li class="list-group-item"><b>Editor :</b>&nbsp {{ $book->editor }}</li>
                        <li class="list-group-item"><b>Copy Editor :</b>&nbsp {{ $book->copy_editor }}</li>
                        <li class="list-group-item"><b>ISBN :</b>&nbsp {{ $book->publisher }}</li>
                        <li class="list-group-item"><b>Edition :</b>&nbsp {{ $book->edition }}</li>
                        <li class="list-group-item"><b>Description :</b>&nbsp {{ $book->description }}</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <small>Created at: {{ $book->created_at }}</small> &nbsp;&nbsp;&nbsp;
                    <small>Updated at: {{ $book->updated_at }}</small>
                    <a class="float-right" href="{{ route('books.index') }}">
                        <button type="button" class="btn btn-info">Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection