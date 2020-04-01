@extends('template.layout2')
@section('title', 'Person Data')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        {{ Breadcrumbs::render('person') }}
                    </nav>
                </div>

                <div class="col-lg-6 col-5 text-right">
                    <a href="javascript:void(0)" id="addNew" class="btn btn-sm btn-neutral">Add Person</a>
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
                        <table class="table table-primary table-bordered data-table table-responsive">
                            <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th width="20%">Name</th>
                                    <th width="10%">Phone Number</th>
                                    <th>Address</th>
                                    <th width="8%">Action</th>
                                </tr>
                            </thead>
                        </table>
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
                        <form id="personForm" name="personForm" class="form-horizontal">
                            <input type="hidden" name="person_id" id="person_id">
                            
                            <div class="form-group">
                                <label for="name" class="col-sm-2">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Type the name of person" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-sm-6">Phone Number</label>
                                <div class="col-sm-12">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Type the phone number of person" value="" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="address" class="col-sm-2">Address</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="address" id="address" cols="10" rows="3" placeholder="Type Description"></textarea>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="description" class="col-sm-2">Description</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="description" id="description" cols="10" rows="5" placeholder="Type Description"></textarea>
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
                
                ajax: "{{ route('person.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'address', name: 'address'},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                ],
                order: [[1, 'asc']]
            });

            $('#addNew').click(function() {
                $('#saveBtn').val("add-person");
                $('#person_id').val('');
                $('#personForm').trigger("reset");
                $('#modelHeading').html("Add New Person");
                $('#ajaxModel').modal('show');
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

            $('#saveBtn').click(function (e) {
               e.preventDefault();
               $(this).html('Sending...');

               $.ajax({
                   data : $('#personForm').serialize(),
                   url : "{{ route('person.store') }}",
                   type : "POST",
                   dataType : 'json',
                   success: function (data) {
                       $('#personForm').trigger("reset");
                       $('#ajaxModel').modal('hide');
                       $('#saveBtn').html('Save Changes');
                       table.draw();
                   },

                   error: function (data) {
                       console.log('Error: ', data);
                       $('#saveBtn').html('Save Changes');
                   }
               });
            });

            $('body').on('click', '.deletePerson', function () {
     
                var person_id = $(this).data("id");
                if (confirm("Are You sure want to delete !")) {
                    $.ajax({
                    type: "DELETE",
                    url: "{{ route('person.store') }}"+'/'+person_id,
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