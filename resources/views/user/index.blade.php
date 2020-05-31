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
                        <div class="offset-8 col-lg-2 mr--3">
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
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active btn-default" id="user-tab" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user" aria-selected="true">Users Table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-default" id="role-tab" data-toggle="pill" href="#pills-role" role="tab" aria-controls="pills-role" aria-selected="false">Roles Table</a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-user" role="tabpanel" aria-labelledby="user-tab">
                    <!-- Members list group card -->
                    <div class="card">
                        <!-- Card body -->
                        <div class="card-body">

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
                    <!-- Roles group card -->
                    <div class="card">
                        <!-- Card body -->
                        <div class="card-body">

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

        <div id="ajaxModel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modelHeading"></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="roleForm" name="roleForm" class="form-horizontal">
                            <input type="hidden" name="role_id" id="role_id">

                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label for="name" class="col-sm-2">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="name" id="role_name" class="form-control" placeholder="Type the role" value="" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="is_active" class="form-control-label">Active?</label>
                                    <div class="form-group" id="is_active">
                                        <label class="custom-toggle">
                                            <input id="is_active" class="is_active" type="checkbox" checked>
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                        </label>
                                        <input type="hidden" name="is_active" id="hidden_active" value="y">
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save Changes</button>
                            </div>
                        </form>
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

            // Roles control

            $('.is_active').change(function(){
                if($(this).prop('checked'))
                {
                    $('#hidden_active').val('y');
                }
                else
                {
                    $('#hidden_active').val('n');
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

            $('#addNewRole').click(function() {
                $('#saveBtn').val("add-role");
                $('#role_id').val('');
                $('#roleForm').trigger("reset");
                $('#modelHeading').html("Add New Role");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editRole', function() {
                var role_id = $(this).data('id');
                $.get("{{ route('roles.index') }}" + '/' + role_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Data <strong>" + data.name + "</strong>");
                    $('#saveBtn').val("edit-role");
                    $('#ajaxModel').modal('show');
                    $('#role_id').val(data.id);
                    $('#role_name').val(data.name);
                    if (data.is_active == 'y') {
                        $('.is_active').prop('checked', true).change();
                    } else {
                        $('.is_active').prop('checked', false).change();
                    }
                    $('#hidden_active').val(data.is_active);
                })
            });

            $('#saveBtn').click(function (e) {
               e.preventDefault();
               $(this).html('Sending...');
                $("#overlay").fadeIn(300);

               $.ajax({
                   data : $('#roleForm').serialize(),
                   url : "{{ route('roles.store') }}",
                   type : "POST",
                   dataType : 'json',
                   success: function (data) {
                       $('#roleForm').trigger("reset");
                       $('#ajaxModel').modal('hide');
                       $('#saveBtn').html('Save Changes');
                       setTimeout(function(){
                            $("#overlay").fadeOut(300);
                        },500);
                       table.draw();
                   },

                   error: function (data) {
                       console.log('Error: ', data);
                       $('#saveBtn').html('Save Changes');
                   }
               });
            });

            $('body').on('click', '.deleteRole', function () {

                var role_id = $(this).data("id");
                if (confirm("Are You sure want to delete !")) {
                    $.ajax({
                    type: "DELETE",
                    url: "{{ route('roles.store') }}"+'/'+role_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                }
            });

            // end roles control

        });
    </script>
@endpush
