@extends('template.layout2')
@section('title', 'Edit Books Data')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        {{ Breadcrumbs::render('detail_book', $book) }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">

    <div class="row">
        <div class="col-xl-8 col-lg-8 margin-tb">
            <!-- Members list group card -->
            <div class="card">
                <!-- Card body -->
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" aria-describedby="title" value="{{ $book->title }}" placeholder="Type the Title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_translate">Title Translate</label>
                                    <input type="text" name="title_translate" class="form-control" id="title_translate" aria-describedby="title_translate" value="{{ $book->title_translate }}" placeholder="Type the Title if Translated Book">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" name="author" class="form-control" id="author" aria-describedby="author" value="{{ $book->author }}" placeholder="Type the Author">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editor">Editor</label>
                                    <input type="text" name="editor" class="form-control" id="editor" aria-describedby="editor" value="{{ $book->editor }}" placeholder="Type the Editor">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="copy_editor">Copy Editor</label>
                                    <input type="text" name="copy_editor" class="form-control" id="copy_editor" aria-describedby="copy_editor" value="{{ $book->copy_editor }}" placeholder="Type the Copy Editor">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="publisher">Publisher</label>
                                    <input type="text" name="publisher" class="form-control" id="publisher" aria-describedby="publisher" value="{{ $book->publisher }}" placeholder="Type the Publisher">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="isbn">ISBN</label>
                                    <input type="text" name="isbn" class="form-control" id="isbn" aria-describedby="isbn" value="{{ $book->isbn }}" placeholder="Type the ISBN">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edition">Edition</label>
                                    <input type="text" name="edition" class="form-control" id="edition" aria-describedby="edition" value="{{ $book->edition }}" placeholder="Type the Edition">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="4">{{ $book->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('books.index') }}">
                                    <button type="button" class="btn btn-danger">Cancel</button>
                                </a>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
