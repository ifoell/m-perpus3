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
                    <table class="table table-borderless">
                        <tr>
                            <td><b>Title</b></td>
                            <td>: {{ $book->title }}</td>
                        </tr>
                        <tr>
                            <td><b>Original Title</b></td>
                            <td>: {{ $book->title_translate }}</td>
                        </tr>
                        <tr>
                            <td><b>Author</b></td>
                            <td>: {{ $book->author }}</td>
                        </tr>
                        <tr>
                            <td><b>Editor</b></td>
                            <td>: {{ $book->editor }}</td>
                        </tr>
                        <tr>
                            <td><b>Copy Editor</b></td>
                            <td>: {{ $book->copy_editor }}</td>
                        </tr>
                        <tr>
                            <td><b>ISBN</b></td>
                            <td>: {{ $book->isbn }}</td>
                        </tr>
                        <tr>
                            <td><b>Edition</b></td>
                            <td>: {{ $book->edition }}</td>
                        </tr>
                        <tr>
                            <td><b>Description</b></td>
                            <td>: {{ $book->description }}</td>
                        </tr>
                    </table>
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