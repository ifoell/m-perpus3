@extends('template.layout')

@section('content')

<div class="container mt-5">
    {{ Breadcrumbs::render('add') }}
    <div class="row justify-content-center align-items-center">
        <div class="card- col-10">
            <div class="card-header">
                <h3>Add New Book</h3>
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

                <form method="POST" action="{{ route('books.store') }}" id="booksForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" aria-describedby="title" placeholder="Type the Title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title_translate">Title Translate</label>
                                <input type="text" name="title_translate" class="form-control" id="title_translate" aria-describedby="title_translate" placeholder="Type the Title if Translated Book">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" name="author" class="form-control" id="author" aria-describedby="author" placeholder="Type the Author">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editor">Editor</label>
                                <input type="text" name="editor" class="form-control" id="editor" aria-describedby="editor" placeholder="Type the Editor">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="copy_editor">Copy Editor</label>
                                <input type="text" name="copy_editor" class="form-control" id="copy_editor" aria-describedby="copy_editor" placeholder="Type the Copy Editor">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="publisher">Publisher</label>
                                <select name="publisher" id="publisher" class="form-control">
                                    <option value="">~ Select Publisher ~</option>
                                    @foreach ($publishers as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input type="text" name="isbn" class="form-control" id="isbn" aria-describedby="isbn" placeholder="Type the ISBN">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edition">Edition</label>
                                <input type="text" name="edition" class="form-control" id="edition" aria-describedby="edition" placeholder="Type the Edition">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="4"></textarea>
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

@endsection