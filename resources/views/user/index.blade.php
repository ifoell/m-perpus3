@extends('template.layout2')
@section('title', 'Users Data')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        {{ Breadcrumbs::render('user') }}
                    </nav>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="{{ route('user.create') }}" id="addNew" class="btn btn-sm btn-neutral">Add User Data</a>
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
                    <div id="flashmsg"></div>
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
                                    <th width="20%">Full Name</th>
                                    <th width="20%">Username</th>
                                    <th width="25%">E-Mail</th>
                                    <th>Role</th>
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
                
                ajax: "{{ route('user.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
                    {data: 'name', name: 'users.name'},
                    {data: 'username', name: 'users.username'},
                    {data: 'email', name: 'users.email'},
                    {data: 'roles', name: 'roles.name'},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                ],
                order: [[1, 'asc']]
            });

            $('#addNew').click(function() {
                window.location.href='{{ route('borrow.create') }}';
            });

            $('body').on('click', '.showBorrow', function() {
                var borrow_id = $(this).data('id');
                window.location.href = "/admin/borrow/" + borrow_id + '/detail';
            });

            $('body').on('click', '.editBorrow', function() {
                var borrow_id = $(this).data('id');
                window.location.href = "/admin/borrow/" + borrow_id + '/edit';
            });

            $('body').on('click', '.deleteBorrow', function () {
     
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                if (confirm("Are You sure want to delete !")) {
                    $.ajax({
                    type: "DELETE",
                    url: "borrow/delete"+'/'+id,
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (data) {
                        console.log('Success:', data);
                        table.draw();
                        
                        $('#flashmsg').html(
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                                '<strong>Data Deleted Successfully<strong>'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                    '<span aria-hidden="true">&times;</span>'+
                                '</button>'+
                            '</div>')
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