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

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-striped table-hover">
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
                                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info">
                                            <i class="ni ni-zoom-split-in"></i></a>
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-success">
                                            <i class="ni ni-ruler-pencil"></i>
                                        </a>

                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="ni ni-fat-remove"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
