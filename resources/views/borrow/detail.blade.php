@extends('template.layout2')
@section('title', $borrow[0]->book->title)
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
<div class="container-fluid mt--6">

    <div class="row">
        <div class="col-xl-8 col-lg-8 margin-tb">
            <!-- Members list group card -->
            <div class="card">
                <!-- Card body -->
                <div class="card-body">
                    <table class="table table-borderless" id="borrowDetails">
                        <tr>
                            <td><b>Title</b></td>
                            <td>: {{ $borrow[0]->book->title }}</td>
                        </tr>
                        <tr>
                            <td><b>ISBN</b></td>
                            <td>: {{ $borrow[0]->book->isbn }}</td>
                        </tr>
                        <tr>
                            <td><b>Publisher</b></td>
                            <td>: {{ $publisher[0]->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Edition</b></td>
                            <td>: {{ $borrow[0]->book->edition }}</td>
                        </tr>
                        <tr>
                            <td><b>Person Name</b></td>
                            <td>: {{ $borrow[0]->person->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Phone Number</b></td>
                            <td>: {{ $borrow[0]->person->phone }}</td>
                        </tr>
                        <tr>
                            <td><b>Address</b></td>
                            <td>: {{ $borrow[0]->person->address }}</td>
                        </tr>
                        <tr>
                            <td><b>Ownership</b></td>
                            <td>: 
                                @if ($borrow[0]->ownership == 'o' && $borrow[0]->person->gender == 'm')
                                    {{ 'His' }}
                                @elseif ($borrow[0]->ownership == 'o' && $borrow[0]->person->gender == 'f')
                                    {{ 'Hers' }}
                                @else
                                    {{ 'Mine' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td>: {{ ($borrow[0]->status == '0')? 'Still Borrow' : 'Returned' }}</td>
                        </tr>
                        <tr>
                            <td><b>Borrow at</b></td>
                            <td>: {{ !empty($borrow[0]->borrow_at)? date('d M Y', strtotime($borrow[0]->borrow_at)): '' }}</td>
                        </tr>
                        <tr>
                            <td><b>Return at</b></td>
                            <td>: {{ !empty($borrow[0]->return_at)? date('d M Y', strtotime($borrow[0]->return_at)): '' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <small>Created at: {{ $borrow[0]->created_at }}</small> &nbsp;&nbsp;&nbsp;
                    <small>Updated at: {{ $borrow[0]->updated_at }}</small>
                    <div class="float-right">
                        <button type="button" class="btn btn-success returnBorrow" data-id="{{ $borrow[0]->id }}">Return Book</button>
                        <a href="{{ route('borrow.index') }}">
                            <button type="button" class="btn btn-info">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl4 col-lg-4 position-sticky">
            <div class="card">
                <div class="card-header pt-3 pb-2">
                    <h3 class="text-lg-center">~~ Information ~~</h3>
                </div>
                <div class="card-body">
                    <h4>Books Description</h4>
                    <p><small>{{ $borrow[0]->book->description }}</small></p>
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
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '.returnBorrow', function() {
                var borrow_id = $(this).data('id');
                if (confirm("Is this book already returned ?")) {
                    $.ajax({
                        type: "PUT",
                        url: "/admin/borrow/return" + '/' + borrow_id,
                        data: { "id": borrow_id },
                        success: function(data) {
                            console.log('Success: ', data);
                            $('#borrowDetails').load(window.location + " #borrowDetails");

                            $('#flashmsg').html(
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                                '<strong>Book Returned Successfully<strong>'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                    '<span aria-hidden="true">&times;</span>'+
                                '</button>'+
                            '</div>')
                        },
                        error: function(data) {
                            console.log('Error: ', data);

                            $('#flashmsg').html(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                                '<strong>Data Return Book Failed to Submit<strong>'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                    '<span aria-hidden="true">&times;</span>'+
                                '</button>'+
                            '</div>')
                        }
                    })
                }
            });
        });
    </script>
@endpush