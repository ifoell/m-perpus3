@extends('template.layout')

@section('content')

<div class="container mt-5">
    {{ Breadcrumbs::render('book', $book) }}
    <div class="row justify-content-center align-items-center">
        <div class="card- col-10">
            <div class="card-header">
                <h3>Edit Data Book {{ $book->title }}</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('books.update', $book->id) }}" id="booksForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" aria-describedby="title" value="{{ $book->title }}" placeholder="Type the Title">
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" class="form-control" id="author" aria-describedby="author" value="{{ $book->author }}" placeholder="Type the Author">
                    </div>
                    <div class="form-group">
                        <label for="editor">Editor</label>
                        <input type="text" name="editor" class="form-control" id="editor" aria-describedby="editor" value="{{ $book->editor }}" placeholder="Type the Editor">
                    </div>
                    <div class="form-group">
                        <label for="copy_editor">Copy Editor</label>
                        <input type="text" name="copy_editor" class="form-control" id="copy_editor" aria-describedby="copy_editor" value="{{ $book->copy_editor }}" placeholder="Type the Copy Editor">
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" name="publisher" class="form-control" id="publisher" aria-describedby="publisher" value="{{ $book->publisher }}" placeholder="Type the Publisher">
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" class="form-control" id="isbn" aria-describedby="isbn" value="{{ $book->isbn }}" placeholder="Type the ISBN">
                    </div>
                    <div class="form-group">
                        <label for="edition">Edition</label>
                        <input type="text" name="edition" class="form-control" id="edition" aria-describedby="edition" value="{{ $book->edition }}" placeholder="Type the Edition">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $book->description }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('books.index') }}">
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection