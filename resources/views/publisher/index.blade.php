@extends('template.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mt-3 mb-3">
            <div class="text-left">
                <h2>Publisher Data</h2>
            </div>
            {{ Breadcrumbs::render('publisher') }}
            <div class="text-right">
                <a href="javascript:void(0)" id="addNew" class="btn btn-primary">Add Publisher</a>
            </div>
        </div>
    </div>

    <table class="table table-responsive table-primary table-bordered data-table">
        <thead>
            <tr>
                <th width="2%">#</th>
                <th width="20%">Name</th>
                <th>Address</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
    </table>

    <div id="ajaxModel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="publisherForm" name="publisherForm" class="form-horizontal">
                        <input type="hidden" name="publisher_id" id="publisher_id">
                        
                        <div class="form-group">
                            <label for="name" class="col-sm-2">Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Type the name of publisher" value="" required>
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
                ajax: "{{ route('publishers.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false},
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    {data: 'action', name: 'action', orderable:false, searchable:false},
                ],
                order: [[1, 'asc']]
            });

            $('#addNew').click(function() {
                $('#saveBtn').val("add-publisher");
                $('#publisher_id').val('');
                $('#publisherForm').trigger("reset");
                $('#modelHeading').html("Add New Publisher");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editPublisher', function() {
                var publisher_id = $(this).data('id');
                $.get("{{ route('publishers.index') }}" + '/' + publisher_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Data <strong>" + data.name + "</strong>");
                    $('#saveBtn').val("edit-publisher");
                    $('#ajaxModel').modal('show');
                    $('#publisher_id').val(data.id);
                    $('#name').val(data.name);
                    $('#address').val(data.address);
                    $('#description').val(data.description);
                })
            });

            $('#saveBtn').click(function (e) {
               e.preventDefault();
               $(this).html('Sending...');

               $.ajax({
                   data : $('#publisherForm').serialize(),
                   url : "{{ route('publishers.store') }}",
                   type : "POST",
                   dataType : 'json',
                   success: function (data) {
                       $('#publisherForm').trigger("reset");
                       $('#ajaxModel').modal('hide');
                       table.draw();
                   },

                   error: function (data) {
                       console.log('Error: ', data);
                       $('#saveBtn').html('Save Changes');
                   }
               });
            });

            $('body').on('click', '.deletePublisher', function () {
     
                var publisher_id = $(this).data("id");
                confirm("Are You sure want to delete !");
            
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('publishers.store') }}"+'/'+publisher_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
@endpush