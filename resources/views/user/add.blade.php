@extends('template.layout2')
@section('title', 'Add User Data')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        {{ Breadcrumbs::render('add_user') }}
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
                    <form method="POST" action="{{ route('user.store') }}" id="borrowForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Full Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Input Full Name" required autocomplete="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="form-control-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Input Username" required autocomplete="username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">E-Mail</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="email@email.com" required autocomplete="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="password">Password</label>
                                    <input class="form-control" name="password" id="password" placeholder="Input password" type="password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="password-confirm">Confirm Password</label>
                                    <input class="form-control" name="password_confirmation" id="password-confirm" placeholder="Input password" type="password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="roles_id" class="form-control-label">Roles</label>
                                    <select name="roles_id" id="roles_id" class="roles_id form-control" data-toggle="select">
                                        <option value="" selected disabled>~ Select Roles ~</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lockout_time" class="form-control-label">Lock Time (in Minutes)</label>
                                    <input type="number" name="lockout_time" id="lockout_time" class="form-control" placeholder="Input Lock Time Minutes" value="10" required autocomplete="lockout_time">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="is_active" class="form-control-label">Active ?</label>
                                <div class="form-group" id="is_active">
                                    <label class="custom-toggle">
                                        <input id="is_active" class="is_active" type="checkbox" checked>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                    </label>
                                    <input type="hidden" name="is_active" id="hidden_active" value="y">
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('user.index') }}">
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
    <script>
        // csrf token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){

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

            $("#roles_id").select2({
                ajax: {
                    url: "{{ url('/api/roles') }}",
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