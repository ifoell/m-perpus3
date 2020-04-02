@extends('template.layout2')
@section('title', 'Edit Borrowing Data')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        {{ Breadcrumbs::render('detail_borrow', $borrow[0]->book->title) }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6 pb-5">

    <div class="row">
        <div class="col-xl-8 col-lg-8 margin-tb">
            <!-- Members list group card -->
            <div class="card">
                <!-- Card body -->
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Whoops!</strong> There were some problems with your input.
                        <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('borrow.update', $borrow[0]->id) }}" id="borrowForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="book_id">Books</label>
                                    <select name="book_id" id="books_id" class="books_title form-control" data-toggle="select">
                                        <option value="" selected disabled>~ Select Books ~</option>
                                        @foreach ($book as $b)
                                        <option value="{{ $b->id }}" {{ $borrow[0]->book_id == $b->id? 'selected' : '' }}>{{ $b->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="person_id">Person</label>
                                    <select name="person_id" id="person_id" class="person_name form-control" data-toggle="select">
                                        <option value="" selected disabled>~ Select Person ~</option>
                                        @foreach ($person as $p)
                                        <option value="{{ $p->id }}" {{ $borrow[0]->person_id == $p->id? 'selected' : '' }}>{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ownership">Ownership</label>
                                    <select name="ownership" id="ownership" class="form-control">
                                        <option value="m" {{ $borrow[0]->ownership == 'm'? 'selected': '' }}>Mine</option>
                                        <option value="o" {{ $borrow[0]->ownership == 'o'? 'selected': '' }}>His / Hers</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="borrow_at">Borrow From</label>
                                  <input class="form-control datepicker" name="borrow_at" id="borrow_at"
                                    placeholder="Select date" type="text" data-date-format="yyyy-mm-dd" value="{{ $borrow[0]->borrow_at }}">
                                </div>
                              </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('borrow.index') }}">
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

@push('styles')
@endpush

@push('scripts')
<script src="{{ asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
@endpush