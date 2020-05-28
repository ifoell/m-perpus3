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

                <div class="col-lg-6 text-right">
                    <div class="row">
                        <div class="offset-8 col-lg-2">
                            <a href="#addRole" id="addNewRole" class="btn btn-sm btn-success">Add Role Data</a>
                        </div>
                        <div class="col-lg-2">
                            <a href="{{ route('user.create') }}" id="addNew" class="btn btn-sm btn-neutral">Add User Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">

    <div class="row">
        <div class="col-xl-12 col-lg-12 margin-tb mt-3 mb-3">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="user-tab" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user" aria-selected="true">Users Table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="role-tab" data-toggle="pill" href="#pills-role" role="tab" aria-controls="pills-role" aria-selected="false">Roles Table</a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-user" role="tabpanel" aria-labelledby="user-tab">
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
                                            <th width="5%">Active?</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-role" role="tabpanel" aria-labelledby="role-tab">
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
                                <table style="width: 100%" class="table table-primary table-bordered data-table-role table-responsive">
                                    <thead>
                                        <tr>
                                            <th width="2%">#</th>
                                            <th>Name</th>
                                            <th width="20%">is_active</th>
                                            <th width="8%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
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
                    {data: 'is_active', name: 'users.is_active'},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                ],
                order: [[1, 'asc']]
            });

            $('#addNew').click(function() {
                window.location.href='{{ route('user.create') }}';
            });

            $('body').on('click', '.editUser', function() {
                var user_id = $(this).data('id');
                window.location.href = "/admin/user/" + user_id + '/edit';
            });

            $('body').on('click', '.deleteUser', function () {

                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                if (confirm("Are You sure want to delete !")) {
                    $.ajax({
                    type: "DELETE",
                    url: "user/delete"+'/'+id,
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

            var table = $('.data-table-role').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,

                ajax: "{{ route('roles.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false},
                    {data: 'name', name: 'name'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                ],
                order: [[1, 'asc']]
            });

        });
    </script>
@endpush
