@extends('template.layout2')
@section('title', $book->title)
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
                    <table class="table table-borderless">
                        <tr>
                            <td><b>Title</b></td>
                            <td>: {{ $book->title }}</td>
                        </tr>
                        @if ($book->title_translate != null)
                        <tr>
                            <td><b>Original Title</b></td>
                            <td>: {{ $book->title_translate }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><b>Author</b></td>
                            <td>: {{ $book->author }}</td>
                        </tr>
                        <tr>
                            <td><b>Editor</b></td>
                            <td>: {{ $book->editor }}</td>
                        </tr>
                        @if ($book->copy_editor != null)
                        <tr>
                            <td><b>Copy Editor</b></td>
                            <td>: {{ $book->copy_editor }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><b>Publisher</b></td>
                            <td>: {{ $book->publisher->name }}</td>
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
</div>

@endsection
