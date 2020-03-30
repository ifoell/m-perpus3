@extends('template.layout2')
@section('title', 'Books Data')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        {{ Breadcrumbs::render('books') }}
                    </nav>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('books.create') }}" class="btn btn-sm btn-neutral">New</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">

    <div class="row">
        <div class="col-xl-12 col-lg-12 margin-tb mt-3 mb-3">
            <!-- Members list group card -->
            <div class="card">
                <!-- Card body -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>
                            <p>{{ $message }}</p>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive" id="booksTable" data-toggle="list" data-list-values='["title", "author", "publisher", "isbn"]'>
                        <table class="table align-items-center table-flush table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="sort" data-sort="title">Title</th>
                                    <th scope="col" class="sort" data-sort="author">Author</th>
                                    <th scope="col" class="sort" data-sort="publisher">Publisher</th>
                                    <th scope="col" class="sort" data-sort="isbn">isbn</th>
                                    <th scope="col">Edition</th>
                                    <th scope="col" width="160px">Action</th>
                                </tr>
                            </thead>

                            @foreach ($books as $key => $book)
                            <tbody class="list">
                                <tr>
                                    <td scope="row">{{ $key+1 }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ Str::limit($book->author,20) }}</td>
                                    <td>{{ Str::limit($book->publisher->name,20) }}</td>
                                    <td>{{ $book->isbn }}</td>
                                    <td>{{ Str::limit($book->edition,16) }}</td>
                                    <td>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="post">
                                            <a onclick="window.location.href = '{{ route('books.show', $book->id) }}'" href="javascript:void(0);" class="btn btn-sm btn-info" title="Show Data">
                                                <i class="ni ni-zoom-split-in"></i></a>
                                            <a onclick="window.location.href = '{{ route('books.edit', $book->id) }}'" href="javascript:void(0);" class="btn btn-sm btn-success" title="Edit Data">
                                                <i class="ni ni-ruler-pencil"></i>
                                            </a>

                                            @csrf
                                            @method('delete')
                                            <a href="javascript:void(0);">
                                            <button type="submit" onclick="$(this).closest('form').submit();" class="btn btn-sm btn-danger" title="Delete Data">
                                                <i class="ni ni-fat-remove"></i>
                                            </button>
                                        </a>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small>Page : {{ $books->currentPage() }}</small> &nbsp;&nbsp;&nbsp; |
                    <small>Total Data : {{ $books->total() }}</small>&nbsp;&nbsp;&nbsp; |
                    <small>Data per Page : {{ $books->perPage() }}</small>
                    <div class="float-right">
                        <small>{{ $books->links() }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection