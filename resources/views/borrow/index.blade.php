@extends('template.layout2')
@section('title', 'Borrow Books Data')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        {{ Breadcrumbs::render('borrow') }}
                    </nav>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('borrow.create') }}" id="addNew" class="btn btn-sm btn-neutral">Add Borrow Data</a>
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

                    <div class="table-responsive pr-2 pl-2">
                        <table style="width: 100%" class="table table-primary table-bordered data-table table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="20%">Book Title</th>
                                    <th width="20%">ISBN</th>
                                    <th width="25%">Person</th>
                                    <th>Phone</th>
                                    <th>Ownership</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                
                ajax: "{{ route('borrow.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false},
                    {data: 'title', name: 'books.title'},
                    {data: 'isbn', name: 'books.isbn'},
                    {data: 'name', name: 'person.name'},
                    {data: 'phone', name: 'person.phone'},
                    {data: 'ownership', name: 'borrow.ownership'},
                    {data: 'status', name: 'borrow.status'},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                ],
                columnDefs : [
                    { "targets" : 5,
                    render : function (data, type, row) {
                        switch(data) {
                        case 'o' : return 'His / Hers'; break;
                        case 'm' : return 'Mine'; break;
                        default  : return 'N/A';
                        }
                    }
                    },
                    {
                    "targets" : 6,
                    render : function (data, type, row) {
                        switch(data) {
                        case '0' : return 'Still Borrow'; break;
                        case '1' : return 'Returned'; break;
                        default  : return 'N/A';
                        }
                    }
                    }
                ],
                order: [[1, 'asc']]
            });

            $('#addNew').click(function() {
                window.location.href='{{ route('borrow.create') }}';
            });

            $('body').on('click', '.editPerson', function() {
                var person_id = $(this).data('id');
                $.get("{{ route('person.index') }}" + '/' + person_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Data <strong>" + data.name + "</strong>");
                    $('#saveBtn').val("edit-person");
                    $('#ajaxModel').modal('show');
                    $('#person_id').val(data.id);
                    $('#name').val(data.name);
                    $('#phone').val(data.phone);
                    $('#address').val(data.address);
                    $('#description').val(data.description);
                })
            });

            $('body').on('click', '.deleteBorrow', function () {
     
                var borrow_id = $(this).data("id");
                if (confirm("Are You sure want to delete !")) {
                    $.ajax({
                    type: "DELETE",
                    url: "{{ route('borrow.store') }}"+'/'+person_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                }
            });

        });
    </script>
@endpush