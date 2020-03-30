@extends('template.layout2')
@section('title', 'Add Books Data')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        {{ Breadcrumbs::render('add_book') }}
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
                                    <label for="publisher_id">Publisher</label>
                                    <select name="publisher_id" id="publisher_id" class="publisher_name form-control" data-toggle="select">
                                        <option value="" selected disabled>~ Select Publisher ~</option>
                                        {{-- @foreach ($publishers as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach --}}
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
</div>

@endsection

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('scripts')
    <script>
        // csrf token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){

            $("#publisher_id").select2({
                ajax: {
                    url: "{{ route('get_publisher') }}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search:  params.term //search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            // results: response
                            results: $.map(response, function(obj) {
                                return { id: obj.id, text: obj.name };
                            })
                        };
                    },
                    cache: true
                }

            });

        });
    </script>
@endpush