@extends('template.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mt-3 mb-3">
            <div class="text-left">
                <h2>Books Data</h2>
            </div>
            {{ Breadcrumbs::render('books') }}
            <div class="text-right">
                <a href="{{ route('books.create') }}" >
                    <x-button btn="primary" type="button" title="Add Book"/>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><p>{{ $message }}</p></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Publisher</th>
            <th>ISBN</th>
            <th>Edition</th>
            <th width="160px">Action</th>
        </tr>

        @foreach ($books as $key => $book)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->edition }}</td>
                <td>
                    <form action="{{ route('books.destroy', $book->id) }}" method="post">
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info"><ion-icon name="eye"></ion-icon></a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-success"><ion-icon name="create"></ion-icon></a>
                            
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger"><ion-icon name="trash"></ion-icon></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection